<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Category;

class ProjectController extends Controller
{
    public function index($locale = 'en')
    {
    	return view('projects/index', [
    		'title' => 'Projects',
    		'projects' => \Auth::user()->projects()->withCount('likes')->withCount('dislikes')->withCount('comments')->get(),
    	]);
    }

    public function view($locale = 'en', $id)
    {
        $project = Project::where('slug', $id)->withCount('likes')->withCount('dislikes')->firstOrFail();
        $categories = Category::all();
        return view('projects/view', [
            'project' => $project,
            'categories' => $categories,
            'title' => $project->title,
        ]);
    }

    public function create($locale = 'en')
    {
    	$categories = Category::all();
    	return view('projects/create', [
    		'categories' => $categories,
    		'title' => 'New project',
    	]);
    }

    public function store(Request $request, $locale = 'en')
    {
    	$project = \Auth::user()->projects()->create($request->all());
        $project->categories()->sync($request->categories ?? []);
        $project->generateSlug();
        return redirect()->route('projects.view', [app()->getLocale(), $project->slug])->with('success', 'Project created');
    }

    public function update(Request $request, $locale = 'en', $id)
    {
        $project = Project::where('slug', $id)->firstOrFail();
        $project->update($request->all());
        $project->categories()->sync($request->categories ?? []);
        $project->generateSlug();
        return redirect()->route('projects.view', [app()->getLocale(), $project->slug])->with('success', 'Project updated');
    }

    public function delete($locale = 'en', $id)
    {
        $project = Project::where('slug', $id)->firstOrFail();
        $project->delete();
        return redirect()->route('projects', app()->getLocale())->with('success', 'Project deleted');
    }
}
