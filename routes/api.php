<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthPersonnelController;
use App\Http\Controllers\Auth\AuthClientController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\SousTacheController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\Affectation\PersoEquipeController;


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
    Route::apiResource('/equipes', EquipeController::class);
    Route::post('/persoequipeAdd', [PersoEquipeController::class, 'attachPerso']);
    Route::post('/persoequipeRemove', [PersoEquipeController::class, 'detachPerso']);
    Route::apiResource('/projets', ProjetController::class);
    Route::apiResource('/taches', TacheController::class);
    Route::apiResource('/soustaches', SousTacheController::class);
    Route::apiResource('/comments', TacheController::class);
    Route::apiResource('/reponses', ReponseController::class);
    Route::delete('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'type.personnel'])->group(function () {
    Route::post('/password', [AuthPersonnelController::class, 'changePassword']);
    Route::delete('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'type.client'])->group(function () {
    Route::post('/password', [AuthClientController::class, 'changePassword']);
    Route::apiResource('/tickets', TicketController::class);
    Route::delete('/logout', [AuthController::class, 'logout']);
});

