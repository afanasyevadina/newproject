<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use \App\Http\Controllers\Controller;
use App\Article;
use App\Comment;

class BlogController extends Controller
{
	public function comments($id)
	{
		$article = Article::findOrFail($id);
		$comments = $article->comments()->whereNull('reply_to')->with('user')->withCount('likes')->withCount('dislikes')->with(['replies' => function($query) {
            return $this->recursiveComments($query);
        }])->get();
		if(\Request::get('sort') == 'new') {
			$comments = $comments->sortByDesc('created_at')->values()->all();
		} else {
			$comments = $comments->sortByDesc('rating')->values()->all();
		}
		return response()->json([
			'comments' => $comments,
			'count' => $article->comments()->count(),
		]);
	}
	
	public function comment(Request $request, $id)
	{
		$article = Article::findOrFail($id);
		$comment = $article->comments()->create(array_merge($request->all(), ['user_id' => \Auth::id()]));
		return response()->json($comment);
	}

	private function recursiveComments($query)
	{
		return $query->with('user')->withCount('likes')->withCount('dislikes')->with(['replies' => function($q) {
			return $this->recursiveComments($q);
		}]);
    }
    
	public function like($id)
	{
		$article = Article::findOrFail($id);
		$old = $article->rates()->where('user_id', \Auth::user()->id)->first();
		if(!$old || !$old->rate) $article->rates()->create(['user_id' => \Auth::id(), 'rate' => 1]);
		if($old) $old->delete();
		return response()->json([
			'likes' => $article->likes()->count(),
            'dislikes' => $article->dislikes()->count(),
            'liked' => $article->liked,
            'disliked' => $article->disliked,
		]);
	}

	public function dislike($id)
	{
		$article = Article::findOrFail($id);
		$old = $article->rates()->where('user_id', \Auth::user()->id)->first();
		if(!$old || $old->rate) $article->rates()->create(['user_id' => \Auth::id(), 'rate' => 0]);
		if($old) $old->delete();
		return response()->json([
			'likes' => $article->likes()->count(),
            'dislikes' => $article->dislikes()->count(),
            'liked' => $article->liked,
            'disliked' => $article->disliked,
		]);
	}
}