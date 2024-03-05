<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\usersController;
use App\http\Controllers\CategoriesController;


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
Route::post('register', [usersController::class, "register"]);
Route::post('login', [usersController::class, "login"]);

Route::group(["middleware" => ["auth:api"]], function(){

    Route::get("profile", [usersController::class, "profile"]);
    Route::post("logout", [usersController::class, "logout"]);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




   // CategoriesController.Api

   Route::post("create_category", [CategoriesController::class, "store"]);
   Route::post("update_category/{id}", [CategoriesController::class, "update"]);
   Route::delete("delete_category/{id}", [CategoriesController::class, "destroy"]);
   Route::middleware('auth:api')->get("list_categories", [CategoriesController::class, "index"]);
   Route::get("single_category/{id}", [CategoriesController::class, "show"]);