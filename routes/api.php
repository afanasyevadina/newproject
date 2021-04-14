<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('/profile/{id}/subscribe', 'Api\ProfileController@subscribe')->name('subscribe');
	Route::get('/profile/{id}/unsubscribe', 'Api\ProfileController@unsubscribe')->name('unsubscribe');
	Route::post('/blog/{id}/comment', 'Api\BlogController@comment')->name('blog.comment');
	Route::post('/notes/{id}/comment', 'Api\NoteController@comment')->name('note.comment');
	Route::get('/blog/{id}/like', 'Api\BlogController@like')->name('blog.like');
	Route::get('/blog/{id}/dislike', 'Api\BlogController@dislike')->name('blog.dislike');
	Route::get('/comments/{id}/like', 'Api\CommentController@like')->name('comment.like');
	Route::get('/comments/{id}/dislike', 'Api\CommentController@dislike')->name('comment.dislike');
	Route::get('/projects/{id}/like', 'Api\ProjectController@like')->name('project.like');
	Route::get('/projects/{id}/dislike', 'Api\ProjectController@dislike')->name('project.dislike');
});
Route::get('/notes/{id}/comments', 'Api\NoteController@comments')->name('note.comments');
Route::get('/blog/{id}/comments', 'Api\BlogController@comments')->name('blog.comments');
