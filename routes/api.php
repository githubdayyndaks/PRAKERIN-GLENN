<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\PostController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//api route
//<project url>/api/register
Route::post("register",[ApiController::class, "register"]);
Route::post("login",[ApiController::class,"login"]);
Route::post("tambah",[PostController::class,"tambah"]);
Route::post("edit/{id}",[PostController::class,"edit"]);
ROute::delete("delete/{id}", [PostController::class, "delete"]);

Route::group(
    [
        "middleware" => ["auth:api"]
    ], function(){
        Route::get("profile",[ApiController::class,"profile"]);
        Route::get("refresh",[ApiController::class,"refreshToken"]);
        ROute::get("logout", [ApiController::class, "logout"]);

    }
);

Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
