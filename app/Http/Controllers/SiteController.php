<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;

class SiteController extends Controller
{
    public function index($locale = 'en')
    {
    	return view('index', [
    		'title' => 'Home',
    	]);
    }

    public function search($locale = 'en')
    {
    	$articles = Article::where(\DB::raw("concat(title, subtitle, content)"), 'like', '%'.\Request::get('q').'%')
    	->orWhereHas('user', function($query) {
    		$query->where(\DB::raw("concat(name, email)"), 'like', '%'.\Request::get('q').'%');
    	})
    	->orWhereHas('categories', function($query) {
    		$query->where(\DB::raw("concat(name_en, name_ru)"), 'like', '%'.\Request::get('q').'%');
    	})->get();
    	$users = User::where(\DB::raw("concat(name, email)"), 'like', '%'.\Request::get('q').'%')->get();
    	return view('search', [
    		'articles' => $articles,
    		'users' => $users,
    		'title' => 'Search results',
    	]);
    }
}
