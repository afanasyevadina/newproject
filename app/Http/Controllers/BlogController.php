<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;

class BlogController extends Controller
{
    public function index($locale = 'en')
    {
    	$articles = Article::all();
    	return view('blog/index', [
    		'articles' => $articles,
    		'title' => 'Blog',
    	]);
    }

    public function view($locale = 'en', $id)
    {
        $article = Article::where('slug', $id)->firstOrFail();
        return view('blog/view', [
            'article' => $article,
            'title' => $article->title,
        ]);
    }

    public function create($locale = 'en')
    {
    	$categories = Category::all();
    	return view('blog/create', [
    		'categories' => $categories,
    		'title' => 'New article',
    	]);
    }

    public function store(Request $request, $locale = 'en')
    {
    	$article = \Auth::user()->articles()->create($request->all());
        $article->categories()->sync($request->categories ?? []);
        $article->generateSlug();
        return redirect()->route('blog.view', [app()->getLocale(), $article->slug])->with('success', 'Article created');
    }
}
