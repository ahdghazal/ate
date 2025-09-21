<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, UserController, FoodController, FoodLogController, WaterController, WorkoutController, SummaryController};


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('workouts', WorkoutController::class);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);

    Route::get('/me',[UserController::class,'me']);
    Route::put('/me',[UserController::class,'update']);

    Route::get('/foods',[FoodController::class,'index']);
    Route::post('/food-logs',[FoodLogController::class,'store']);

    Route::post('/water-logs',[WaterController::class,'store']);
    Route::post('/workouts',[WorkoutController::class,'store']);

    Route::get('/summary/today',[SummaryController::class,'today']);

});