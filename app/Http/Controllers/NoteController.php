<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Project;

class NoteController extends Controller
{
    public function view($locale = 'en', $id)
    {
        $note = Comment::where('slug', $id)->withCount('likes')->withCount('dislikes')->firstOrFail();
        return view('notes/view', [
            'note' => $note,
            'title' => $note->title,
        ]);
    }

    public function create($locale = 'en', $id)
    {
    	$project = \Auth::user()->projects()->findOrFail($id);
    	return view('notes/create', [
    		'project' => $project,
    		'title' => 'New note',
    	]);
    }

    public function store(Request $request, $locale = 'en', $id)
    {
        $project = \Auth::user()->projects()->findOrFail($id);
    	$note = $project->comments()->create(array_merge($request->all(), ['user_id' => \Auth::id()]));
        $note->generateSlug();
        return redirect()->route('notes.view', [app()->getLocale(), $note->slug])->with('success', 'Note created');
    }

    public function edit($locale = 'en', $id)
    {
        $note = Comment::where('slug', $id)->firstOrFail();
        if($note->user_id != \Auth::id()) abort(403);
        return view('notes/edit', [
            'note' => $note,
            'title' => $note->title,
        ]);
    }

    public function update(Request $request, $locale = 'en', $id)
    {
        $note = Comment::where('slug', $id)->firstOrFail();
        if($note->user_id != \Auth::id()) abort(403);
        $note->update($request->all());
        $note->generateSlug();
        return redirect()->route('notes.view', [app()->getLocale(), $note->slug])->with('success', 'Note updated');
    }

    public function delete($locale = 'en', $id)
    {
        $note = Comment::where('slug', $id)->firstOrFail();
        if($note->user_id != \Auth::id()) abort(403);
        $projectId = $note->commentable->slug;
        $note->delete();
        return redirect()->route('projects.view', [app()->getLocale(), $projectId])->with('success', 'Note deleted');
    }
}
