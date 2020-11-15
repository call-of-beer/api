<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeerController;

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

//authController

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/logout', [AuthController::class, 'Logout']);

});

Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'Login']);

Route::post('/beer/store', [BeerController::class, 'store']);
Route::get('/beer/all', [BeerController::class, 'getAll']);
Route::get('/beer/{id}', [BeerController::class, 'show']);
Route::put('/beer/edit/{beer}', [BeerController::class, 'edit']);
Route::delete('/beer/delete/{id}', [BeerController::class, 'delete']);
