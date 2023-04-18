<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\MenuController;
use App\http\Controllers\MejaController;

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
 // making route for table menu
 Route::get('/getmenu',[MenuController::class, 'getmenu']);
 Route::get('/getmenu/{id}',[MenuController::class, 'getmenuid']);
 Route::post('/createmenu',[MenuController::class, 'createmenu']);
 Route::put('/updatemenu/{id}',[MenuController::class, 'updatemenu']);
 Route::delete('/deletemenu/{id}',[MenuController::class, 'deletemenu']);
 
 // making route for table meja
 Route::get('/getmeja',[MejaController::class, 'getmeja']);
 Route::get('/getmeja/{id}',[MejaController::class, 'getmejaid']);
 Route::post('/createmeja',[MejaController::class, 'createmeja']);
 Route::put('/updatemeja/{id}',[MejaController::class, 'updatemeja']);
 Route::delete('/deletemeja/{id}',[MejaController::class, 'deletemeja']);
