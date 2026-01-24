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
Route::get('/monsters/{monster}/{slug}', [MonstersController::class, 'show'])->name('monsters.show');
Route::get('/monsters/create', [MonstersController::class, 'create'])->name('monsters.create');

Route::post('/monsters', [MonstersController::class, 'store'])->name('monsters.store');