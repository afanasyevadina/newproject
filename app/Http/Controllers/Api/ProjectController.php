<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use \App\Http\Controllers\Controller;
use App\Project;

class ProjectController extends Controller
{
    
	public function like($id)
	{
		$project = Project::findOrFail($id);
		$old = $project->rates()->where('user_id', \Auth::user()->id)->first();
		if(!$old || !$old->rate) $project->rates()->create(['user_id' => \Auth::id(), 'rate' => 1]);
		if($old) $old->delete();
		return response()->json([
			'likes' => $project->likes()->count(),
            'dislikes' => $project->dislikes()->count(),
            'liked' => $project->liked,
            'disliked' => $project->disliked,
		]);
	}

	public function dislike($id)
	{
		$project = Project::findOrFail($id);
		$old = $project->rates()->where('user_id', \Auth::user()->id)->first();
		if(!$old || $old->rate) $project->rates()->create(['user_id' => \Auth::id(), 'rate' => 0]);
		if($old) $old->delete();
		return response()->json([
			'likes' => $project->likes()->count(),
            'dislikes' => $project->dislikes()->count(),
            'liked' => $project->liked,
            'disliked' => $project->disliked,
		]);
	}
}