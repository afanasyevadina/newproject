<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use \App\Http\Controllers\Controller;
use App\Comment;

class NoteController extends Controller
{
	public function comments($id)
	{
		$note = Comment::findOrFail($id);
		$comments = $note->comments()->whereNull('reply_to')->with('user')->withCount('likes')->withCount('dislikes')->with(['replies' => function($query) {
            return $this->recursiveComments($query);
        }])->get();
		return response()->json([
			'comments' => $comments,
			'count' => $note->comments()->count(),
		]);
	}
	
	public function comment(Request $request, $id)
	{
		$note = Comment::findOrFail($id);
		$comment = $note->comments()->create(array_merge($request->all(), ['user_id' => \Auth::id()]));
		return response()->json($comment);
	}

	private function recursiveComments($query)
	{
		return $query->with('user')->withCount('likes')->withCount('dislikes')->with(['replies' => function($q) {
			return $this->recursiveComments($q);
		}]);
	}
}