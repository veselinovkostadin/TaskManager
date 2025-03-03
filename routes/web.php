<?php

use App\Http\Middleware\CheckOwner;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return redirect()->route("login");
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(CheckOwner::class)->group(function () {
        Route::resource("/projects", ProjectController::class);

        Route::get("/tasks/{project}", [TaskController::class, "index"])->name("tasks.index");
        Route::get("/tasks/create/{project}", [TaskController::class, "create"])->name("tasks.create");
        Route::post("/tasks/{project}", [TaskController::class, "store"])->name("tasks.store");
        Route::get("/tasks/edit/{task}", [TaskController::class, "edit"])->name("tasks.edit");
        Route::put("/tasks/update/{task}", [TaskController::class, "update"])->name("tasks.update");
        Route::delete("/tasks/delete/{task}", [TaskController::class, "destroy"])->name("tasks.destroy");
    });
});



require __DIR__ . '/auth.php';
