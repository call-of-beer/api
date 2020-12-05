<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\IngredientsController;

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

Route::group(
    [

    'middleware' => 'api',
    'prefix' => 'auth'

    ], function ($router) {

        Route::post('/logout', [AuthController::class, 'Logout']);

    }
);

Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'Login']);



Route::group(['middleware' => ['role:admin']], function () {

    //Types of beer
    Route::get('/type', [\App\Http\Controllers\TypeBeerController::class, 'index']);
    Route::post('/type', [\App\Http\Controllers\TypeBeerController::class, 'store']);
    Route::delete('/type/{type}', [\App\Http\Controllers\TypeBeerController::class, 'destroy']);
});



Route::group(['middleware' => ['role:drinker|admin']], function () {    //routy dostępne dla zalogowanych userów i admina

    Route::post('/group/add', [GroupController::class, 'store']);
    Route::get('/group/all', [GroupController::class, 'getAllGroups']);
    Route::get('/group/{groupId}', [GroupController::class, 'getGroup']);
    Route::put('/group/update/{group}', [GroupController::class, 'editGroup']);
    Route::post('/group/{groupId}/addUser', [GroupController::class, 'addUserToGroup']);
    Route::delete('/group/{group}/{user}/delete', [GroupController::class, 'removeUserFromGroup']);

    Route::get('/user/group/all/', [GroupController::class, 'getAllGroupsWhereUserIsMember']);
    Route::get('/tastings', [\App\Http\Controllers\TastingController::class, 'index']);
    Route::post('/tasting/{group}', [\App\Http\Controllers\TastingController::class, 'store']);
    Route::patch('/tasting/{id}', [\App\Http\Controllers\TastingController::class, 'edit']);
    Route::delete('/tasting/{tasting}', [\App\Http\Controllers\TastingController::class, 'destroy']);
});

Route::group([
    'middleware' => ['can:admin group']
], function () {
    Route::delete('/group/{group}', [GroupController::class, 'destroy']);
    Route::post('/group/{group}', [GroupController::class, 'addUserToGroup']);
});



//open routes

Route::post('/beer/store', [BeerController::class, 'store']);
Route::get('/beer/all', [BeerController::class, 'getAll']);
Route::get('/beer/all/my', [BeerController::class, 'getMyBeers']);
Route::get('/beer/{id}', [BeerController::class, 'show']);
Route::post('/beer/{beer}/{tasting}', [BeerController::class, 'joinBeerToTasting']);
Route::put('/beer/edit/{beer}', [BeerController::class, 'edit']);
Route::delete('/beer/delete/{id}', [BeerController::class, 'delete']);

Route::post('/rating/store', [RatingController::class, 'store']);
Route::get('/rating/all', [RatingController::class, 'getAll']);
Route::get('/rating/{id}', [RatingController::class, 'show']);
Route::get('/rating/user/{user_id}', [RatingController::class, 'userRating']);
Route::get('/rating/beer/{beer_id}', [RatingController::class, 'beerRating']);
Route::put('/rating/edit/{rating}', [RatingController::class, 'edit']);
Route::delete('/rating/delete/{id}', [RatingController::class, 'delete']);

//ingredients
Route::get('/ingredient', [IngredientsController::class, 'index']);
Route::post('/ingredient/{beer}', [IngredientsController::class, 'store']);
Route::delete('/ingredient', [IngredientsController::class, 'destroy']);

//tasting


//gradingscales
Route::get('/gradingscale', [\App\Http\Controllers\GradingScaleController::class, 'index']);
Route::post('/gradingscale', [\App\Http\Controllers\GradingScaleController::class, 'store']);
Route::delete('/gradingscale/{gradingscale}', [\App\Http\Controllers\GradingScaleController::class, 'destroy']);

//types of beer

