<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterCheckController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserInformationController;
use App\Http\Controllers\DynamicController;

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
Route::post('/edit_user_information', [UserInformationController::class, 'edit_user_information']);
Route::post('/index_get', [DynamicController::class, 'index_get']);
Route::post('/get_category', [DynamicController::class, 'get_category']);
Route::post('/create_matters', [DynamicController::class, 'create_matters']);
Route::middleware('auth:sanctum')->post('/me', [RegisterCheckController::class, 'me']);
Route::post('/default_matters', [DynamicController::class, 'default_matters']);
Route::post('/get_matters', [DynamicController::class, 'get_matters']);