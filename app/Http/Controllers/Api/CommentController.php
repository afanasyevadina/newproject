<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use \App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
	public function like($id)
	{
		$comment = Comment::findOrFail($id);
		$old = $comment->rates()->where('user_id', \Auth::user()->id)->first();
		if(!$old || !$old->rate) $comment->rates()->create(['user_id' => \Auth::id(), 'rate' => 1]);
		if($old) $old->delete();
		return response()->json([
			'likes' => $comment->likes()->count(),
			'dislikes' => $comment->dislikes()->count(),
		]);
	}

	public function dislike($id)
	{
		$comment = Comment::findOrFail($id);
		$old = $comment->rates()->where('user_id', \Auth::user()->id)->first();
		if(!$old || $old->rate) $comment->rates()->create(['user_id' => \Auth::id(), 'rate' => 0]);
		if($old) $old->delete();
		return response()->json([
			'likes' => $comment->likes()->count(),
			'dislikes' => $comment->dislikes()->count(),
		]);
	}
}