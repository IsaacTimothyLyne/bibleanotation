<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest can view authentication pages', function () {
    $this->get('/login')->assertSuccessful();
    $this->get('/register')->assertSuccessful();
    $this->get('/forgot-password')->assertSuccessful();
    $this->get('/reset-password/test-token?email=test@example.com')->assertSuccessful();
});

test('authenticated users can view security settings and password confirmation', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/settings/security')
        ->assertSuccessful();

    $this->actingAs($user)
        ->get('/user/confirm-password')
        ->assertSuccessful();
});

test('guests are redirected away from protected auth settings pages', function () {
    $this->get('/settings/security')->assertRedirect('/login');
    $this->get('/user/confirm-password')->assertRedirect('/login');
});
