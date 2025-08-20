<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Currency\Http\Controllers\ExchangeController;
use App\Modules\Currency\Http\Controllers\CurrencyController;

Route::prefix('currency')->group(function () {
    // Rates
    Route::get('/', [ExchangeController::class, 'index'])->name('currency.exchange.index');
    Route::get('/convert', [ExchangeController::class, 'showConverter'])->name('currency.exchange.converter');
    Route::post('/convert', [ExchangeController::class, 'convert'])->name('currency.exchange.convert');

    // Currencies
    Route::get('/currencies', [CurrencyController::class, 'index'])->name('currency.currencies.index');
    Route::get('/currencies/create', [CurrencyController::class, 'create'])->name('currency.currencies.create');
    Route::post('/currencies', [CurrencyController::class, 'store'])->name('currency.currencies.store');
    Route::delete('/currencies/{id}', [CurrencyController::class, 'destroy'])->name('currency.currencies.destroy');
});


