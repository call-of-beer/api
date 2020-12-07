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
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
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

    Route::get('/attribute', [\App\Http\Controllers\TasteAttributesController::class, 'index']);
    Route::post('/attribute/{beer}', [\App\Http\Controllers\TasteAttributesController::class, 'store']);
    Route::delete('/attribute/{attribute}', [\App\Http\Controllers\TasteAttributesController::class, 'destroy']);

    Route::get('/beer/all/my', [BeerController::class, 'getMyBeers']);
    Route::post('/beer/store/{type_beer}/{country}', [BeerController::class, 'store']);
    Route::get('/beer/{id}', [BeerController::class, 'show']);
    Route::post('/beer/{beer}/{tasting}', [BeerController::class, 'joinBeerToTasting']);
    Route::put('/beer/edit/{beer}', [BeerController::class, 'edit']);
    Route::delete('/beer/delete/{id}', [BeerController::class, 'delete']);
});

Route::group([
    'middleware' => ['can:admin group']
], function () {
    Route::delete('/group/{group}', [GroupController::class, 'destroy']);
    Route::post('/group/{group}', [GroupController::class, 'addUserToGroup']);
});



//open routes

Route::get('/country', [\App\Http\Controllers\CountryController::class, 'index']);
Route::get('/type', [\App\Http\Controllers\TypeBeerController::class, 'index']);


Route::get('/beers', [BeerController::class, 'getAll']);

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


Route::get('/rating/all', [RatingController::class, 'getAll']);
Route::get('/rating/selected/{beer}', [RatingController::class, 'getSelected']);
Route::post('/rating/store/{beer}', [RatingController::class, 'store']);
Route::get('/rating/average/{beer}', [RatingController::class, 'getAvg']);

//ADMIN
Route::group(['middleware' => ['role:admin']], function () {

    //Types of beer
    Route::post('/type', [\App\Http\Controllers\TypeBeerController::class, 'store']);
    Route::delete('/type/{type}', [\App\Http\Controllers\TypeBeerController::class, 'destroy']);

    //country
    Route::post('/country/new', [\App\Http\Controllers\CountryController::class, 'store']);
    Route::delete('/country/delete/{country}', [\App\Http\Controllers\CountryController::class, 'destroy']);
});
