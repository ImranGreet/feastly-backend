<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'categories');
    Route::post('/categories', 'createCategory');
    Route::get('/categories/{id}', 'getCategory');
    Route::put('/categories/{id}', 'updateCategory');
    Route::delete('/categories/{id}', 'deleteCategory');
});

Route::middleware('auth:sanctum')->controller(OrganizationController::class)->group(function () {
    Route::get('/organization', 'index');
    Route::post('/organization', 'store');
    Route::get('/organization/{id}', 'show');
    Route::put('/organization/{id}', 'update');
    Route::delete('/organization/{id}', 'destroy');
});
