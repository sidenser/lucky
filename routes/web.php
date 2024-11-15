<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\LuckyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\CheckUserLink;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/registration', [RegistrationController::class, 'register'])->name('registration.register');

Route::middleware([CheckUserLink::class])->prefix('lucky')->group(function () {
    Route::get('/{link}/history', [LuckyController::class, 'history'])->name('lucky.history');
    Route::get('/{link}', [LuckyController::class, 'index'])->name('lucky.index');
    Route::post('/{link}', [LuckyController::class, 'game'])->name('lucky.game');
});

Route::middleware([CheckUserLink::class])->prefix('link')->group(function () {
    Route::post('/{link}/regenerate', [LinkController::class, 'regenerate'])->name('link.regenerate');
    Route::post('/{link}/disable', [LinkController::class, 'disable'])->name('link.disable');
});

