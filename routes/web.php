<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirect');
Route::get('/auth/callback/{provider}', [SocialiteController::class, 'handleProviderCallback'])->name('socialite.callback');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/videos/{id}', [App\Http\Controllers\HomeController::class, 'showVideo'])->name('videos.show');
