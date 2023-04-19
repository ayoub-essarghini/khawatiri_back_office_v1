<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\LikesController;
use App\Http\Controllers\Api\QuotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//user
Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::get('logout',[AuthController::class,'logout']);
Route::post('save_user_info',[AuthController::class,'saveUserInfo'])->middleware('jwtAuth');
Route::post('update_user_info',[AuthController::class,'updateUserInfo'])->middleware('jwtAuth');
//Route::post('login','Api/AuthController@login');

//categories 
Route::get('categories',[CategoriesController::class,'categories'])->middleware('jwtAuth');
//quotes
Route::get('quotes',[QuotesController::class,'quotes'])->middleware('jwtAuth');
Route::post('quotes/create',[QuotesController::class,'create'])->middleware('jwtAuth');
Route::post('quotes/delete',[QuotesController::class,'delete'])->middleware('jwtAuth');
Route::post('quotes/update',[QuotesController::class,'update'])->middleware('jwtAuth');
Route::post('quotes/my_quotes',[QuotesController::class,'myQuotes'])->middleware('jwtAuth');
//comment
Route::post('quotes/comments',[CommentsController::class,'comments'])->middleware('jwtAuth');
Route::post('comments/create',[CommentsController::class,'create'])->middleware('jwtAuth');
Route::post('comments/delete',[CommentsController::class,'delete'])->middleware('jwtAuth');
Route::post('comments/update',[CommentsController::class,'update'])->middleware('jwtAuth');
//like
Route::post('quotes/like',[LikesController::class,'like'])->middleware('jwtAuth');
