<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneBookController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [PhoneBookController::class, 'index']);
Route::post('/store', [PhoneBookController::class, 'store'])->name('store');
Route::get('/fetchall', [PhoneBookController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete', [PhoneBookController::class, 'delete'])->name('delete');
Route::get('/edit', [PhoneBookController::class, 'edit'])->name('edit');
Route::post('/update', [PhoneBookController::class, 'update'])->name('update');
