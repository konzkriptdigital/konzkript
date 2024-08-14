<?php

use App\Http\Controllers\GhlController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PaddleController;
use App\Livewire\Pages\Checkout;
use App\Livewire\Pages\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

/* Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); */

Volt::route('dashboard', 'pages.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('auth/hl/callback', [GhlController::class, 'code']);

Route::get('auth/google/redirect', [GoogleController::class, 'googleOauth'])
    ->name('google.oauth');

Route::get('auth/google/callback', [GoogleController::class, 'googleCallback'])
    ->name('google.callback');

/*
Volt::route('setting/pricing', 'pages.pricing')
    ->middleware(['auth', 'verified'])
    ->name('pricing'); */
Route::get('setting/pricing', Pricing::class)
    ->middleware(['auth', 'verified'])
    ->name('setting.pricing');


Route::get('setting/checkout/{plan}', Checkout::class)
    ->middleware(['auth', 'verified'])
    ->name('setting.checkout');


Route::get('/test', function (Request $request) {
    $checkout = $request->user()->subscribe('pri_01j4y51q2y31y5aepd313n4nae','default');

    return view('livewire.test', ['checkout' => $checkout]);
})->name('test');


// Route::post('paddle/webhook', [PaddleController::class, 'webhook']);

require __DIR__.'/auth.php';
