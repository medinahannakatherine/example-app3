<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use  App\Http\Controllers\API\OrderController;
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


Route::post('/register',[AuthController::class,'register']);

Route::post('/login', [AuthController::class,'login']);
//Route::middleware('auth:api')->post('/auth/logout', [AuthController::class,'logout'] );

Route::middleware('auth:api')->post('/order', [OrderController::class,'store']);

