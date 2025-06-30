<?php 

use Citadel\Controllers\FilepondController;
use Illuminate\Support\Facades\Route;




Route::prefix('@/c/filepond')
    ->name('citadel.filepond.')
    ->group(function() {
        Route::post('/process', [FilepondController::class, 'process'])->name('process');
        // Route::get('/load/{filepath?}', [FilepondController::class, 'load'])->name('load');
        Route::get('/load', [FilepondController::class, 'load'])->name('load');
        Route::get('/restore/{filepath?}', [FilepondController::class, 'restore'])->name('restore');
    });