<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;

class BlogController extends Controller
{
    public function index($locale = 'en')
    {
    	$articles = Article::withCount('likes')->withCount('dislikes')->withCount('comments')->get();
    	return view('blog/index', [
    		'articles' => $articles,
    		'title' => 'Blog',
    	]);
    }

    public function view($locale = 'en', $id)
    {
        $article = Article::where('slug', $id)->withCount('likes')->withCount('dislikes')->firstOrFail();
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

    public function edit($locale = 'en', $id)
    {
        $article = Article::where('slug', $id)->firstOrFail();
        $categories = Category::all();
        return view('blog/edit', [
            'article' => $article,
            'categories' => $categories,
            'title' => $article->title,
        ]);
    }

    public function update(Request $request, $locale = 'en', $id)
    {
        $article = Article::where('slug', $id)->firstOrFail();
        $article->update($request->all());
        $article->categories()->sync($request->categories ?? []);
        $article->generateSlug();
        return redirect()->route('blog.view', [app()->getLocale(), $article->slug])->with('success', 'Article updated');
    }

    public function delete($locale = 'en', $id)
    {
        $article = Article::where('slug', $id)->firstOrFail();
        $article->delete();
        return redirect()->route('blog', app()->getLocale())->with('success', 'Article deleted');
    }
}
