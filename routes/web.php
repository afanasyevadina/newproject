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
