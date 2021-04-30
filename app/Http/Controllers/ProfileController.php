<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;

class ProfileController extends Controller
{
    public function index($locale = 'en')
    {
        return view('profile/home', [
        	'title' => 'Profile',
        ]);
    }

    public function settings($locale = 'en')
    {
        $categories = Category::all();
    	return view('profile/settings', [
        	'title' => 'Profile settings',
            'user' => User::with('interests')->with('skills')->with('goals')->findOrFail(\Auth::id()),
            'categories' => $categories,
        ]);
    }

    public function saveSettings(Request $request, $locale = 'en')
    {
    	\Auth::user()->update($request->all());
        \Auth::user()->interests()->sync($request->interests ?? []);
        \Auth::user()->skills()->sync($request->skills ?? []);
        \Auth::user()->goals()->sync($request->goals ?? []);
        \Auth::user()->generateSlug();
    	return redirect()->back()->with('success', 'Profile info updated');
    }

    public function view($locale = 'en', $id)
    {
    	$user = User::where('slug', $id)->firstOrFail();
        if(\Auth::check() && $user->id == \Auth::id()) return redirect()->route('profile', app()->getLocale());
    	return view('profile/view', [
    		'user' => $user,
        	'title' => $user->name,
        ]);
    }
}
