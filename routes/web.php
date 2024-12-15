<?php

use App\Http\Controllers\ClothesCategoryController;
use App\Http\Controllers\ClothesMovingController;
use App\Http\Controllers\ClothingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DressingController;
use App\Http\Controllers\MoveClothingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuitcaseGuideController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('clothes-categories', ClothesCategoryController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('dressings', DressingController::class)->except('index');

    Route::get('/clothes/move', [ClothesMovingController::class, 'index'])->name("clothes.move.index");
    Route::get('/clothes/move/from/{origin}/to/{destination}', [ClothesMovingController::class, 'create'])->name("clothes.move.create");
    Route::post('/clothes/move/from/{origin}/to/{destination}', [ClothesMovingController::class, 'store'])->name("clothes.move.store");
    Route::resource('dressings.clothes', ClothingController::class)->shallow()->parameters([
        'clothes' => 'clothing',
    ]);

    Route::post('/clothes/{clothing}/move-to-dressing/{dressing}', MoveClothingController::class)->name("clothes.move-to-dressing");

    Route::get('/suitcase', [SuitcaseGuideController::class, 'index'])->name("suitcase.index");
    Route::get('/suitcase/from/{origin}/to/{destination}', [SuitcaseGuideController::class, 'show'])->name("suitcase.show");
});

require __DIR__ . '/auth.php';
