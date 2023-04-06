<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\MenuController;
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
 // making route for table siswa
 Route::get('/getmenu',[MenuController::class, 'getmenu']);
 Route::get('/getmenu/{id}',[MenuController::class, 'getmenuid']);
 Route::post('/createmenu',[MenuController::class, 'createmenu']);
