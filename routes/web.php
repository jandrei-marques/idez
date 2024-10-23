<?php

use App\Http\Controllers\BrasilApiController;
use App\Http\Controllers\IbgeController;
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
Route::get('/teste', function () {
    return 'Rota de teste funcionando!';
});
Route::get('/brasilapi', [BrasilApiController::class, 'index']);
Route::get('/brasilapi/municipios/{estadoId?}', [BrasilApiController::class, 'municipios']);
Route::get('/ibge', [IbgeController::class, 'index']);
Route::get('/ibge/municipios/{estadoId?}', [IbgeController::class, 'municipios']);
