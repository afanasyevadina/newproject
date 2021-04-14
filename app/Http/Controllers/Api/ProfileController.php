<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use \App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller
{
	public function subscribe($id)
	{
		$user = User::findOrFail($id);
		$user->subscribers()->firstOrCreate(['subscriber_id' => \Auth::id()]);
		return response()->json([
			'subscribed' => 1,
		]);
	}

	public function unsubscribe($id)
	{
		$user = User::findOrFail($id);
		$user->subscribers()->where('subscriber_id', \Auth::id())->delete();
		return response()->json([
			'subscribed' => 0,
		]);
	}
}