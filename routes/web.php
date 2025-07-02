<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [PlayerController::class, 'index'])->name('players.index');
Route::get('/players/{id}', [PlayerController::class, 'show'])->name('players.detail');
Route::resource('players', PlayerController::class);
Route::get('/players/{id}/edit', [PlayerController::class, 'edit'])->name('players.edit');
Route::post('/players/{id}/update', [PlayerController::class, 'update'])->name('players.update');