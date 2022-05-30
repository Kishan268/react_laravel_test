<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BooksController;

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
Route::post("admin/login",[UserController::class,'userLogin']);
Route::post("admin/register",[UserController::class,'userRegister']);
Route::post("admin/add_books",[BooksController::class,'addUserBooks']);
Route::get("admin/get_books/{id}",[BooksController::class,'getBooks']);

