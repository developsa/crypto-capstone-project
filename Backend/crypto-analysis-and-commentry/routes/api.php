<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GeckoController;
use App\Http\Controllers\GoogleApiController;

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


//COMMENT
//GetAllcomment
Route::get('/getAllComment', [CommentController::class, 'getAllComment']);

//Coin Api
Route::get('/getGeckoDatas', [GeckoController::class, 'saveGeckoData']);

//CoinUserlist
Route::get('/getCoinUserList', [CommentController::class, 'getCoinUserList']);

//Get id comment
Route::get("/comments/{id}", [CommentController::class, "show"]);

//Create
Route::post("/createcomment", [CommentController::class, 'createComment']);

//Update
Route::put("/editcomment/{id}", [CommentController::class, 'update']);

//Delete
Route::delete("/deletecomment/{id}", [CommentController::class, "delete"]);

Route::get("/coin/{gecko_coin_id}",[CommentController::class,"getShowCoin"]);

//User

Route::get("/getAllUser", [UserController::class, 'getAllUser']);
Route::get("/users/{id}", [UserController::class, 'show']);
Route::post("/createuser", [UserController::class, "create"]);
Route::post('/login', [UserController::class, 'loginUser']);
Route::put('/editusers/{id}', [UserController::class, "update"]);
Route::delete("/userdelete/{id}", [UserController::class, "delete"]);



