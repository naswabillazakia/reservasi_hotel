<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// get public bisa diakses tanpa login
 Route::post('/register', [AuthController::class, 'register']);
 Route::post('/login', [AuthController::class, 'login']);
 
 Route::middleware('auth:sanctum')->group(function (){
// get room - public (customer & admin) harus login dulu
Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/hotels/{id}', [HotelController::class, 'show']);
Route::post('/hotels', [HotelController::class, 'store']);
Route::put('/hotels/{id}', [HotelController::class, 'update']);
Route::delete('/hotels/{id}', [HotelController::class, 'destroy']);

 // get reservasi - (customer & admin)
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/{id}', [TransaksiController::class, 'index']);

 // add reservasi - customer
  Route::post('/transaksi', [TransaksiController::class, 'store']);

 // edit reservasi - customer
  Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);


// delete reservasi - (customer & admin)
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);

// logout 
 Route::post('/logout', [AuthController::class, 'logout']);
 });

