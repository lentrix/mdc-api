<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TempStudInfoController;
use App\Http\Controllers\UserController;
use App\Models\TempStudInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//for testing purposes online remove when not needed...
Route::get('/test', function() {
    $sems = \DB::table('sems')->get();
    return response()->json($sems);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class,'register']);

Route::group(['middleware'=>'auth'], function() {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::get('/info', [UserController::class,'info']);
    Route::put('/temp-info/{tempStudInfo}', [TempStudInfoController::class, 'update']);
    Route::get('/basic-info', [UserController::class,'basicInfo']);
});
