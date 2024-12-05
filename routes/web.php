<?php

use App\Http\Controllers\ClothesMovingController;
use App\Http\Controllers\ClothingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DressingController;
use App\Http\Controllers\MoveClothingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('/dressings', DressingController::class)->except('index');

    Route::get('/clothing/move', [ClothesMovingController::class, 'index'])->name("clothing.move.index");
    Route::get('/clothing/move/from/{origin}/to/{destination}', [ClothesMovingController::class, 'create'])->name("clothing.move.create");
    Route::post('/clothing/move/from/{origin}/to/{destination}', [ClothesMovingController::class, 'store'])->name("clothing.move.store");
    Route::resource('/dressings.clothing', ClothingController::class)->shallow();

    Route::post('/clothing/{clothing}/move-to-dressing/{dressing}', MoveClothingController::class)->name("clothing.move-to-dressing");
});

require __DIR__ . '/auth.php';
