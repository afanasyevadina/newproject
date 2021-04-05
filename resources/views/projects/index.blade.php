@extends('layouts.app')

@section('content')
<div class="container">
  <div class="jumbotron">
    <h1 class="mb-5">{{ __('Projects') }}</h1>
    <a href="{{ route('projects.create', app()->getLocale()) }}" class="btn btn-success btn-lg">{{ __('Start new project') }}</a>
  </div>
  <div class="row">
    @foreach($projects as $project)
    <div class="col-lg-4 col-sm-6">
      <div class="card">
        <a href="{{ route('projects.view', [app()->getLocale(), $project->slug]) }}" class="card-body mb-4 text-dark text-decoration-none">
          <h3 class="mb-4">{{ $project->title }}</h3>
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
          <a href="{{ route('profile.view', [app()->getLocale(), $project->user->slug]) }}" class="text-dark d-flex">
            <small>{{ $project->user->name }}</small>
          </a>
          <small class="text-dark">{{ $project->date }}</small>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
