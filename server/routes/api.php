<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\VoteController;

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

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout',[AuthApiController::class, 'logout']);
    Route::get('/profile',[AuthApiController::class, 'profile']);

    Route::post('/posts/{post}/upvote',[VoteController::class, 'upvote'])->name('posts.upvote');
    Route::post('/posts/{post}/downvote',[VoteController::class, 'downvote'])->name('posts.downvote');
    Route::get('/card-information', [PostController::class, 'card_information'])->name('cards.information');

    Route::post('/posts/{post}/comment',[CommentController::class, 'store']);
    Route::post('posts/{post}/rate', [RateController::class, 'store']);
});
