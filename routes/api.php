<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeController;

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

Route::group(['middleware' => ['role:admin']], function () {

Route::post('/typeOfBeer/add', [TypeController::class, 'store']);
Route::put('/typeOfBeer/update/{typeOfBeer}', [TypeController::class, 'update']);
Route::delete('/typeOfBeer/delete/{typeOfBeer}', [TypeController::class, 'destroy']);
});

Route::get('/typeOfBeer/all', [TypeController::class, 'getAll']);
Route::get('/typeOfBeer/{typeOfBeer}', [TypeController::class, 'getOne']);
