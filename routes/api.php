<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoachController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/datauser', [AuthController::class, 'dataUser'])->middleware('auth:sanctum');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// TODO: RUTAS ENTRENADOR
Route::get('/obtenerEntrenadores', [CoachController::class, 'index'])->middleware('auth:sanctum');
Route::post('/crearEntrenador', [CoachController::class, 'store']);
Route::post('/actualizarEntrenador', [CoachController::class, 'update']);