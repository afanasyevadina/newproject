@extends('layouts.app')

@section('content')
<div class="bg-light py-5 shadow">
  <div class="container">
    <div class="d-sm-flex align-items-start justify-content-center justify-content-sm-between">
      <h1 class="mb-4 mb-md-0">{{ __('Projects') }}</h1>
      <a href="{{ route('projects.create', app()->getLocale()) }}" class="btn btn-success btn-lg">{{ __('Start new project') }}</a>
    </div>
  </div>
</div>
<div class="container py-5">
  <div class="row">
    @foreach($projects as $project)
    <div class="col-lg-4 col-sm-6">
      <div class="card h-100 shadow">
        <a href="{{ route('projects.view', [app()->getLocale(), $project->slug]) }}" class="card-body text-dark text-decoration-none">
          <h3 class="mb-2">{{ $project->title }}</h3>
          <small class="d-block text-muted mb-4">{{ $project->user->name }}, {{ $project->date }}</small>
          <p>{!! $project->subtitle !!}</p>
          <div class="d-flex flex-wrap">
            @foreach($project->categories as $category)
            <div class="mr-3 text-primary">
              #{{ $category->name }}
            </div>
            @endforeach
          </div>
        </a>
        <div class="card-footer bg-white d-flex justify-content-between">
          <div class="d-flex">
            <div class="c-pointer d-flex align-items-center mr-4 like-btn" data-href="{{ route('project.like', $project->id) }}" data-likes=".likes-count{{ $project->id }}" data-dislikes=".dislikes-count{{ $project->id }}">
              <span class="mr-1 likes-count{{ $project->id }}">{{ $project->likes_count }}</span>
              <span class="text-success">+</span>
            </div>
            <div class="c-pointer d-flex align-items-center like-btn" data-href="{{ route('project.dislike', $project->id) }}" data-likes=".likes-count{{ $project->id }}" data-dislikes=".dislikes-count{{ $project->id }}">
              <span class="mr-1 dislikes-count{{ $project->id }}">{{ $project->dislikes_count }}</span>
              <span class="text-danger">-</span>
            </div>
          </div>
          <small class="text-dark">{{ $project->comments_count }} {{ __('comments') }}</small>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
@section('scripts')
<script src="/js/likes.js"></script>
@endsection
