<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonstersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('pages.home');

Route::get('/monsters', [MonstersController::class, 'index'])->name('monsters.index');

Route::get('/monsters/create', [MonstersController::class, 'create'])->name('monsters.create');

Route::post('/monsters', [MonstersController::class, 'store'])->name('monsters.store');

Route::get('/monsters/{monster}/edit', [MonstersController::class, 'edit'])->name('monsters.edit');

Route::put('/monsters/{monster}', [MonstersController::class, 'update'])->name('monsters.update');

Route::delete('/monsters/{monster}', [MonstersController::class, 'destroy'])->name('monsters.destroy');

Route::get('/monsters/{monster}/{slug}', [MonstersController::class, 'show'])->name('monsters.show');