<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\GroupController;

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

    //Types of beer
Route::post('/typeOfBeer/add', [TypeController::class, 'store']);
Route::put('/typeOfBeer/update/{typeOfBeer}', [TypeController::class, 'update']);
Route::delete('/typeOfBeer/delete/{typeOfBeer}', [TypeController::class, 'destroy']);
});



Route::group(['middleware' => ['role:drinker|admin']], function () {    //routy dostępne dla zalogowanych userów i admina

    Route::post('/group/add', [GroupController::class, 'store']);
    Route::get('/group/all', [GroupController::class, 'getAllGroups']);
    Route::get('/group/{groupId}', [GroupController::class, 'getGroup']);
    Route::put('/group/update/{group}', [GroupController::class, 'editGroup']);
    Route::delete('/group/delete/{groupId}', [GroupController::class, 'deleteGroup']);
    Route::post('/group/{groupId}/addUser', [GroupController::class, 'addUserToGroup']);
    Route::delete('/group/{group}/{user}/delete', [GroupController::class, 'removeUserFromGroup']);

    
    Route::get('/user/{userId}/group/all/', [GroupController::class, 'getAllGroupsWhereUserIsMember']);

});



//open routes
Route::get('/typeOfBeer/all', [TypeController::class, 'getAll']);
Route::get('/typeOfBeer/{typeOfBeer}', [TypeController::class, 'getOne']);


