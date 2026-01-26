<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonstersController;

Route::resource('monsters', MonstersController::class)->except(['show']);

Route::prefix('monsters')->name('monsters.')->group(function () {

    Route::get('/{monster}/{slug}', [MonstersController::class, 'show'])->name('show');

    Route::get('/search-result', [MonstersController::class, 'search'])->name('search');

    Route::get('/filters-result', [MonstersController::class, 'filter'])->name('filter');
});