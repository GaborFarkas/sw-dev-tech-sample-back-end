<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function() {
    $userObj = new stdClass();
    $userObj->email = 'test@gmail.com';
    $userObj->fname = 'John';
    $userObj->lname = 'Doe';
    $userObj->phone = '+123456789';

    return json_encode($userObj);
});

