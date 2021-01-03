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

Route::group([
    'prefix' => 'auth'
], function ($group) {
    Route::post('/register', [AuthController::class, 'Register']);
    Route::post('/login', [AuthController::class, 'Login']);

});

Route::group(['middleware' => ['api', 'role:drinker|admin']], function () {    //routy dostępne dla zalogowanych userów i admina

    Route::post('/group/add', [GroupController::class, 'store']);
    Route::get('/group/all', [GroupController::class, 'getAllMyGroups']);
    Route::get('/group/{groupId}', [GroupController::class, 'getGroup']);
    Route::put('/group/update/{group}', [GroupController::class, 'editGroup']);
    Route::post('/group/{group}/addUser', [GroupController::class, 'addUserToGroup']);
    Route::get('/group/users/{group}', [GroupController::class, 'getUsersOfGroup']);
    Route::delete('/group/{group}/{user}/delete', [GroupController::class, 'removeUserFromGroup']);

    Route::get('/user/group/all/', [GroupController::class, 'getAllMyGroups']);
    Route::get('/user/group/all/member', [GroupController::class, 'getGroupsWhereUserIsMember']);
    Route::get('/tastings', [\App\Http\Controllers\TastingController::class, 'index']);
    Route::get('/tastings/{group}', [\App\Http\Controllers\TastingController::class, 'getTastingOfGroup']);
    Route::get('/tasting/{tasting}', [\App\Http\Controllers\TastingController::class, 'getTasting']);
    Route::post('/tasting/{group}/{beer}', [\App\Http\Controllers\TastingController::class, 'store']);
    Route::patch('/tasting/{id}', [\App\Http\Controllers\TastingController::class, 'edit']);
    Route::delete('/tasting/{tasting}', [\App\Http\Controllers\TastingController::class, 'destroy']);
    Route::get('/beer/all/my', [BeerController::class, 'getMyBeers']);
    Route::get('/beer/type/{type_beer}', [BeerController::class, 'getBeersOfType']);
    Route::get('/beer/country/{country}', [BeerController::class, 'getBeersOfCountry']);
    Route::post('/beer/store/{type_beer}/{country}', [BeerController::class, 'store']);
    Route::get('/beer/{beer}', [BeerController::class, 'show']);
    Route::get('/beer/tasting/{tasting}', [BeerController::class, 'getBeerOfTasting']);
    Route::post('/beer/{beer}/{tasting}', [BeerController::class, 'joinBeerToTasting']);
    Route::put('/beer/edit/{beer}', [BeerController::class, 'edit']);
    Route::delete('/beer/delete/{beer}', [BeerController::class, 'delete']);

    //comments
    Route::get('/comment/{tasting}', [\App\Http\Controllers\CommentController::class, 'getCommentsOfTasting']);
    Route::get('/comment/my', [\App\Http\Controllers\CommentController::class, 'getMyComments']);
    Route::post('/comment/new/{tasting}', [\App\Http\Controllers\CommentController::class, 'store']);
    Route::delete('/comment/{comment}', [\App\Http\Controllers\CommentController::class, 'remove']);

    //auth user
    Route::get('/user/me', [\App\Http\Controllers\UserController::class, 'getAuthUser']);
});

Route::delete('/group/{group}', [GroupController::class, 'destroy']);

Route::group([
    'middleware' => ['can:admin group']
], function () {

    Route::post('/group/{group}', [GroupController::class, 'addUserToGroup']);
});



//open routes

Route::get('/country', [\App\Http\Controllers\CountryController::class, 'index']);
Route::get('/country/{country}', [\App\Http\Controllers\CountryController::class, 'getCountry']);
Route::get('/type', [\App\Http\Controllers\TypeBeerController::class, 'index']);
Route::get('/type/{typeBeer}', [\App\Http\Controllers\TypeBeerController::class, 'getTypeBeer']);


Route::get('/beers', [BeerController::class, 'getAll']);

Route::post('/rating/store/{beer}', [RatingController::class, 'store']);
Route::get('/rating/all', [RatingController::class, 'getAll']);
Route::get('/rating/{id}', [RatingController::class, 'show']);
Route::get('/rating/user/{user_id}', [RatingController::class, 'userRating']);
Route::get('/rating/beer/{beer_id}', [RatingController::class, 'beerRating']);
Route::put('/rating/edit/{rating}', [RatingController::class, 'edit']);
Route::delete('/rating/delete/{id}', [RatingController::class, 'delete']);


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

    //users
    Route::get('/users/all', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('/users/admin', [\App\Http\Controllers\UserController::class, 'getAdmins']);
    Route::get('/users/drinker', [\App\Http\Controllers\UserController::class, 'getDrinkers']);
    Route::post('/register/new/admin', [AuthController::class, 'RegisterAdmin']);
});
