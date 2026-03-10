<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\MatkulController;

Route::get('/matkul', [MatkulController::class, 'index']);

Route::get('/matkul/create', [MatkulController::class, 'create']);
Route::post('/matkul', [MatkulController::class, 'store']);
Route::get('/matkul/{id}/edit', [MatkulController::class, 'edit']);
Route::put('/matkul/{id}', [MatkulController::class, 'update']);
Route::delete('/matkul/{id}', [MatkulController::class, 'destroy']);
Route::get('/matkul/cetak', [MatkulController::class, 'cetak']);