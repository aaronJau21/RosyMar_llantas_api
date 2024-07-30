<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Tires\BrandTireController;
use App\Http\Controllers\Tires\TireController;
use App\Http\Controllers\Trucks\TrucksController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth'], function () {
  Route::post('login', [AuthController::class, 'login']);
  Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('users')->middleware('auth:sanctum')->group(function () {
  Route::get('', [UserController::class, 'getAllUsers']);
  Route::post('', [UserController::class, 'createUser']);
  Route::get('{id}', [UserController::class, 'getUserById']);
  Route::put('{id}', [UserController::class, 'editUser']);
  Route::delete('{id}', [UserController::class, 'deleteUser']);
  Route::get('/export/excel', [UserController::class, 'export']);
});


Route::prefix('trucks')->middleware('auth:sanctum')->group(function () {
  Route::post('', [TrucksController::class, 'createTrucks']);
  Route::get('', [TrucksController::class, 'getAllTruks']);
  Route::get('{id}', [TrucksController::class, 'trunkById']);
  Route::patch('{id}', [TrucksController::class, 'updatedTruck']);
  Route::delete('{id}', [TrucksController::class, 'deleteTruck']);
  Route::get('/export/excel', [TrucksController::class, 'exportTruck']);
});

Route::get('placas', [TrucksController::class, 'getPlaca'])->middleware('auth:sanctum');


Route::prefix('tire')->middleware('auth:sanctum')->group(function () {
  Route::prefix('brand')->group(function () {
    Route::post('create', [BrandTireController::class, 'createBrandTire']);
    Route::get('', [BrandTireController::class, 'getAllBrandTires']);
    Route::get('{id}', [BrandTireController::class, 'getBrandTireById']);
    Route::patch('{id}', [BrandTireController::class, 'bandTireUpdate']);
    Route::delete('{id}', [BrandTireController::class, 'deleteBrandTire']);
  });
  Route::post('', [TireController::class, 'create']);
  Route::get('', [TireController::class, 'getAllTires']);
  Route::get('{id}', [TireController::class, 'getTiresById']);
  Route::patch('{id}', [TireController::class, 'updateTire']);
  Route::delete('{id}', [TireController::class, 'deleteTire']);
});
