<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$routes = function() {
	Route::group(['middleware' => 'auth'], function() {
		Route::get('/profile', 'ProfileController@index')->name('profile');
		Route::get('/profile/settings', 'ProfileController@settings')->name('profile.settings');
		Route::post('/profile/settings', 'ProfileController@saveSettings')->name('profile.settings');
	});

	Route::get('/', 'SiteController@index')->name('home');
	Route::get('/search', 'SiteController@search')->name('search');
	Route::get('/profile/{id}', 'ProfileController@view')->name('profile.view');

	Route::get('/blog', 'BlogController@index')->name('blog');
	Route::get('/blog/create', 'BlogController@create')->name('blog.create');
	Route::post('/blog/create', 'BlogController@store')->name('blog.create');
	Route::get('/blog/{id}', 'BlogController@view')->name('blog.view');
	Route::get('/blog/{id}/edit', 'BlogController@edit')->name('blog.edit');
	Route::post('/blog/{id}/edit', 'BlogController@update')->name('blog.edit');
	Route::get('/blog/{id}/delete', 'BlogController@delete')->name('blog.delete');

	Route::get('/projects', 'ProjectController@index')->name('projects');
	Route::get('/projects/create', 'ProjectController@create')->name('projects.create');
	Route::post('/projects/create', 'ProjectController@store')->name('projects.create');
	Route::get('/projects/{id}', 'ProjectController@view')->name('projects.view');
	Route::post('/projects/{id}/edit', 'ProjectController@update')->name('projects.edit');
	Route::get('/projects/{id}/delete', 'ProjectController@delete')->name('projects.delete');

	Route::get('/notes/create/{id}', 'NoteController@create')->name('notes.create');
	Route::post('/notes/create/{id}', 'NoteController@store')->name('notes.create');
	Route::get('/notes/{id}', 'NoteController@view')->name('notes.view');
	Route::get('/notes/{id}/edit', 'NoteController@edit')->name('notes.edit');
	Route::post('/notes/{id}/edit', 'NoteController@update')->name('notes.edit');
	Route::get('/notes/{id}/delete', 'NoteController@delete')->name('notes.delete');

	Auth::routes();
};

Route::group([
	'middleware' => 'defaultlocale'
], $routes);

Route::group([
	'prefix' => '{locale}', 
	'where' => ['locale' => 'ru|en'], 
	'middleware' => 'setlocale'
], $routes);

Route::get('/sitemap.xml', function() {
	return response()->view('sitemap')->header('Content-Type', 'application/xml');
});
Route::get('/sitemap.xml', function() {
	return response()->view('sitemap')->header('Content-Type', 'application/xml');
});