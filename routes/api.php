<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\BarangController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('levels', [LevelController::class, 'index']);
Route::post('levels', [LevelController::class, 'store']);
Route::get('levels/{level}', [LevelController::class, 'show']);
Route::put('levels/{level}', [LevelController::class, 'update']);
Route::delete('levels/{level}', [LevelController::class, 'destroy']);

// Users
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::put('users/{user}', [UserController::class, 'update']);
Route::delete('users/{user}', [UserController::class, 'destroy']);

// Categories
Route::prefix('kategori')->group(function() {
    Route::get('/', [KategoriController::class, 'index']);
    Route::get('/{kategori}', [KategoriController::class, 'show']);
    Route::middleware('authorized')->group(function() {
        Route::post('/', [KategoriController::class, 'store']);
        Route::put('/{kategori}', [KategoriController::class, 'update']);
        Route::delete('/{kategori}', [KategoriController::class, 'destroy']);   
    });
});

// Barang
Route::prefix('barang')->group(function() {
    Route::get('/', [BarangController::class, 'index']);
    Route::get('/{barang}', [BarangController::class, 'show']);
    Route::middleware('authorized')->group(function() {
        Route::post('/', [BarangController::class, 'store']);
        Route::put('/{barang}', [BarangController::class, 'update']);
        Route::delete('/{barang}', [BarangController::class, 'destroy']);
    });
});