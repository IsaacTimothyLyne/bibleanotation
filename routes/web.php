<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::middleware('auth')->group(function () {
    Route::get('/settings/security', function () {
        return Inertia::render('Auth/Security');
    })->name('settings.security');
    Route::get('/bible', function () {
        return Inertia::render('Bible');
    })->name('bible.index');
});
