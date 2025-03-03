<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::post("/login", [ApiAuthController::class, "login"]);
Route::post("/register", [ApiAuthController::class, "register"]);
Route::post("/logout", [ApiAuthController::class, "logout"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/projects', [ProjectController::class, "index"]);
    Route::get('/project/{projectId}', [ProjectController::class, "show"]);
    Route::post('/project', [ProjectController::class, "store"]);
    Route::put('/project/{projectId}', [ProjectController::class, "update"]);
    Route::delete('/project/{projectId}', [ProjectController::class, "destroy"]);

    Route::get('/tasks/{projectId}', [TaskController::class, "index"]);
    Route::get('/task/{taskId}/{projectId}', [TaskController::class, "show"]);
    Route::post('/task/{projectId}', [TaskController::class, "store"]);
    Route::put('/task/{taskId}', [TaskController::class, "update"]);
    Route::delete('/task/{taskId}', [TaskController::class, "destroy"]);
});
