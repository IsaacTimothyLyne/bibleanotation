<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
