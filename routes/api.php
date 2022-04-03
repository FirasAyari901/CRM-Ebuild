<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthPersonnelController;
use App\Http\Controllers\Auth\AuthClientController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ClientController;

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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/passforget', [AuthController::class, 'resetNotif']);
Route::post('/personnelpassReset/{id}', [AuthPersonnelController::class, 'reset']);
Route::post('/clientpassReset/{id}', [AuthClientController::class, 'reset']);

Route::middleware(['auth:sanctum', 'type.admin'])->group(function () {
    Route::post('/password', [AuthPersonnelController::class, 'changePassword']);
    Route::apiResource('/personnels', PersonnelController::class);
    Route::apiResource('/clients', ClientController::class);
    Route::delete('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'type.personnel'])->group(function () {
    Route::post('/password', [AuthPersonnelController::class, 'changePassword']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
