<?php

use App\Http\Controllers\BrasilApiController;
use App\Http\Controllers\IbgeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teste', function () {
    return 'Rota de teste funcionando!';
});
Route::get('/brasilapi', [BrasilApiController::class, 'index']);
Route::get('/brasilapi/municipios/{estadoId?}', [BrasilApiController::class, 'municipios']);
Route::get('/ibge', [IbgeController::class, 'index']);
Route::get('/ibge/municipios/{estadoId?}', [IbgeController::class, 'municipios']);