<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\GhlController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PaddleController;
use App\Livewire\Pages\Billing;
use App\Livewire\Pages\Checkout;
use App\Livewire\Pages\Editor;
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


Route::get('/test', function (Request $request) {
    $checkout = $request->user()->subscribe('pri_01j4y51q2y31y5aepd313n4nae','default');
    return view('livewire.test', ['checkout' => $checkout]);
})->name('test');


Route::get('client/script/{company}', [CompanyController::class, 'script'])
    // ->middleware('ghlScript')
    ->name('script');


Route::get('editor/{company}', Editor::class)
    ->name('editor');
/* Route::get('editor', function (Request $request) {
    return view('livewire.pages.editor');
})

->name('main.editor'); */
    // ->middleware('ghlScript')

Route::prefix('settings')->group(function () {
    Route::get('billing', Billing::class)
        ->name('settings.billing');

    Route::get('pricing', Pricing::class)
        ->name('settings.pricing')
        ->middleware(['auth', 'verified']);


    Route::get('checkout/{plan}', Checkout::class)
        ->name('settings.checkout');
})->middleware(['auth', 'verified']);


Volt::route('user-list/{company}/{user}', 'components.widgets.user-list')
    ->name('widget.user-list');

// Route::post('paddle/webhook', [PaddleController::class, 'webhook']);

require __DIR__.'/auth.php';
