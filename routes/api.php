<?php

use App\Http\Controllers\Company\CompanyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'web'])->group(function () {
    Route::get('/companies', [CompanyController::class, 'company']);
    Route::post('/companies', [CompanyController::class, 'store']);
    Route::put('/companies/{company}', [CompanyController::class, 'update']);
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy']);
    Route::patch('/companies/{company}/status', [CompanyController::class, 'updateStatus']);
    
    Route::get('/industries', function () {
        return \App\Models\Industry::all();
    });
});