<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('v1/login', [AuthController::class, 'login_get']);
Route::post('v1/login', [AuthController::class, 'login_post']);
Route::get('v1/logout', [AuthController::class, 'logout']);
Route::get('v1/refresh', [AuthController::class, 'refresh']);
Route::post('v1/register', [AuthController::class, 'register']);

Route::get('v1/jobs', [JobsController::class, 'get_jobs']);
Route::post('v1/job', [JobsController::class, 'post_job']);
Route::get('v1/job/{id}', [JobsController::class, 'get_job']);

Route::get('v1/test', [TestController::class, 'test']);
