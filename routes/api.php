<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\MenuController;
use App\http\Controllers\MejaController;
use App\http\Controllers\UserController;
use App\http\Controllers\TransaksiController;

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
 
 // making route for table meja
 Route::get('/getuser',[UserController::class, 'getuser']);
 Route::get('/getuser/{id}',[UserController::class, 'getuserid']);
 Route::post('/createuser',[UserController::class, 'createuser']);
 Route::put('/updateuser/{id}',[UserController::class, 'updateuser']);
 Route::delete('/deleteuser/{id}',[UserController::class, 'deleteuser']);
 
 // making route for table transaksi
 Route::get('/gethistory',[TransaksiController::class, 'gethistory']);
 Route::get('/gethistory/{code}',[TransaksiController::class, 'selecthistory']);
 
 Route::get('/tampil',[TransaksiController::class, 'tampil']);
 Route::get('/get_ongoin_transaksi/{id}',[TransaksiController::class, 'getongoingtransaksi']);
 Route::get('/gettotalharga/{id}',[TransaksiController::class, 'totalharga']);
 Route::get('/getcart',[TransaksiController::class, 'getcart']);
 Route::get('/getongoing',[TransaksiController::class, 'ongoing']);
 Route::put('/checkout',[TransaksiController::class, 'checkout']);
 Route::put('/transaksi_done/{id}',[TransaksiController::class, 'transaksidone']);
 Route::get('/gettransaksi/{id}',[TransaksiController::class, 'selecttransaksi']);
 Route::post('/createtransaksi',[TransaksiController::class, 'createtransaksi']);
