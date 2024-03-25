<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TournamentRegisterController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//core apis
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/tournament-register', [TournamentRegisterController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// // Package id to catagory
// Route::get('/pack-id-category/{id}', [PackageController::class, 'getcata']);
// Route::get('/category-id-subcategory/{id}', [PackageController::class, 'setsub']);
// Route::get('/subcategory-id-exam/{id}', [PackageController::class, 'exam']);
// Route::get('/exam-id-mcq/{id}', [PackageController::class, 'getmcq']);
// Route::get('/all-package-list', [PackageController::class, 'getAllPackageList']);


