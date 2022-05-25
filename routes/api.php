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
use App\Http\Controllers\DocumentController;
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
Route::delete('/logout', [AuthController::class, 'logout']);
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
    Route::get('/allcomments', [CommentaireController::class, 'index']);
    Route::get('/comment/{id}', [CommentaireController::class, 'show']);
    Route::get('/allresponses', [ReponseController::class, 'index']);
    Route::get('/responses/{id}', [ReponseController::class, 'show']);
    Route::get('/alltickets', [TicketController::class, 'index']);
    Route::get('/ticket/{id}', [TicketController::class, 'show']);
    Route::apiResource('/documents', DocumentController::class);
});

Route::middleware(['auth:sanctum', 'type.personnel'])->group(function () {
    Route::post('/password', [AuthPersonnelController::class, 'changePassword']);
    Route::get('/projects', [ProjetController::class, 'index']);
    Route::get('/projects/{projet}', [ProjetController::class, 'show']);
    Route::get('/tasks', [TacheController::class, 'index']);
    Route::get('/tasks/{id}', [TacheController::class, 'show']);
    Route::get('/subtasks', [SousTacheController::class, 'index']);
    Route::get('/subtasks/{id}', [SousTacheController::class, 'show']);
    Route::apiResource('/comments', CommentaireController::class);
    Route::apiResource('/reponses', ReponseController::class);
    Route::get('/showtickets', [TicketController::class, 'index']);
    Route::get('/ticketById/{id}', [TicketController::class, 'show']);  
});

Route::middleware(['auth:sanctum', 'type.client'])->group(function () {
    Route::post('/password', [AuthClientController::class, 'changePassword']);
    Route::apiResource('/tickets', TicketController::class);
    Route::get('/allprojects', [ProjetController::class, 'index']);
    Route::get('/project/{projet}', [ProjetController::class, 'show']);
    Route::get('/getResponses', [ReponseController::class, 'index']);
    Route::get('/response/{id}', [ReponseController::class, 'show']);
    Route::get('/alldocuments', [DocumentController::class, 'index']);
    Route::get('/document/{id}', [DocumentController::class, 'show']);
});

