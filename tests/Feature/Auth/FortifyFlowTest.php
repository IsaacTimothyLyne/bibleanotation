<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use PragmaRX\Google2FA\Google2FA;

uses(RefreshDatabase::class);

test('user can register with fortify and is authenticated', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect('/');

    $this->assertAuthenticated();

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'display_name' => 'Test User',
    ]);
});

test('user can request and use a password reset link', function () {
    Notification::fake();

    $user = User::factory()->create([
        'email' => 'reset@example.com',
    ]);

    $this->post('/forgot-password', [
        'email' => $user->email,
    ])->assertSessionHasNoErrors();

    $token = null;

    Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use (&$token) {
        $token = $notification->token;

        return true;
    });

    Notification::assertSentTo($user, ResetPassword::class);

    expect($token)->not->toBeNull();

    $this->post('/reset-password', [
        'token' => $token,
        'email' => $user->email,
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ])->assertSessionHasNoErrors();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'new-password',
    ])->assertRedirect('/');
});

test('unverified user can request a new verification email', function () {
    Notification::fake();

    $user = User::factory()->unverified()->create();

    $this->actingAs($user)
        ->post('/email/verification-notification')
        ->assertSessionHasNoErrors();

    Notification::assertSentTo($user, VerifyEmail::class);
});

test('user can complete two factor setup and login challenge', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $this->actingAs($user)
        ->post('/user/confirm-password', [
            'password' => 'password',
        ])
        ->assertSessionHasNoErrors();

    $this->actingAs($user)
        ->post('/user/two-factor-authentication')
        ->assertSessionHasNoErrors();

    $user->refresh();

    expect($user->two_factor_secret)->not->toBeNull();

    $secret = decrypt($user->two_factor_secret);
    $code = app(Google2FA::class)->getCurrentOtp($secret);

    $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->post('/user/confirmed-two-factor-authentication', [
            'code' => $code,
        ])
        ->assertSessionHasNoErrors();

    $user->refresh();

    expect($user->two_factor_confirmed_at)->not->toBeNull();

    $this->actingAs($user)
        ->post('/logout')
        ->assertRedirect('/');

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect('/two-factor-challenge');

    $recoveryCodes = $user->fresh()->recoveryCodes();

    $challengeResponse = $this->post('/two-factor-challenge', [
        'recovery_code' => $recoveryCodes[0],
    ]);

    $challengeResponse->assertStatus(302);
    expect($challengeResponse->headers->get('Location'))->toContain('/');

    $this->assertAuthenticatedAs($user->fresh());
});
