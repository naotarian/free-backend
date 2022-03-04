<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterCheckController;
use App\Http\Controllers\Auth\LoginController;

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
Route::middleware('auth:sanctum')->get('/logout', [LoginController::class, 'logout']);

// Route::post('/register', function() {
//     $res = ['code' => 200, 'msg' => 'OK'];
//     return response()->json($res);
// });
Route::post('/register', [RegisterCheckController::class, 'register']);
Route::post('/register_check', [RegisterCheckController::class, 'index']);
Route::post('/register_token', [RegisterCheckController::class, 'post_token']);
Route::post('/main_register', [RegisterCheckController::class, 'main_register']);
Route::post('/login', [RegisterCheckController::class, 'login']);
Route::post('/me', [RegisterCheckController::class, 'me'])->middleware('auth:sanctum');