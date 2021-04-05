@extends('layouts.app')

@section('content')
<div class="container">
  <div class="jumbotron">
    <h1>{{ $project->title }}</h1>
    <p>
      <a href="{{ route('profile.view', [app()->getLocale(), $project->user->slug]) }}" class="text-dark">{{ $project->user->name }}</a>, {{ __('since') }} {{ $project->date }}
    </p>
  </div>
  <ul class="nav nav-tabs mb-4">
    <li class="nav-item">
      <a href="#main" class="nav-link active" data-toggle="tab">{{ __('Main') }}</a>
    </li>
    <li class="nav-item">
      <a href="#notes" class="nav-link" data-toggle="tab">{{ __('Notes') }}</a>
    </li>
    @if($project->user->id == \Auth::id())
    <li class="nav-item">
      <a href="#settings" class="nav-link" data-toggle="tab">{{ __('Settings') }}</a>
    </li>
    @endif
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade active show" id="main">
      {!! nl2br($project->subtitle) !!}
    </div>
    <div class="tab-pane fade" id="notes">
      <div class="d-flex align-items-start justify-content-between">
        <h3>{{ __('Notes') }}</h3>
        @if($project->user->id == \Auth::id())
        <a href="{{ route('notes.create', [app()->getLocale(), $project->id]) }}" class="btn btn-success">{{ __('New note') }}</a>
        @endif
      </div>
    </div>
    @if($project->user->id == \Auth::id())
    <div class="tab-pane fade" id="settings">
      <form class="row" action="{{ route('projects.edit', [app()->getLocale(), $project->slug]) }}" method="POST" autocomplete="off">
        @csrf
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header">{{ __('Edit project') }}</div>

            <div class="card-body">
              <div class="row">                       
                <div class="col-12 form-group">
                  <label>{{ __('Title') }}</label>
                  <input type="text" class="form-control" name="title" required value="{{ $project->title }}">
                </div>
                <div class="col-12 form-group">
                  <label>{{ __('Subtitle') }}</label>
                  <textarea name="subtitle" rows="5" class="form-control">{{ $project->subtitle }}</textarea>
                </div>
                <div class="col-12">
                  <label class="mb-3">{{ __('Tags') }}</label>
                  <div class="row">
                    @foreach($categories as $category)
                    <div class="col-6 col-lg-4">
                      <label>
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ $project->categories->pluck('id')->contains($category->id) ? 'checked' : '' }}>
                        {{ $category->name }}
                      </label>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary mr-3" data-toggle="modal" data-target="#delete">{{ __('Delete') }}</button>
            <button class="btn btn-primary">{{ __('Save') }}</button>
          </div>
        </div>
      </form>
      <div class="modal fade" id="delete">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center p-5">
              <h3 class="t-l_b-24 mb-4">{{ __('Delete project') }}?</h3>
              <div class="row">
                <div class="col-6">
                  <a class="btn btn-secondary btn-block" href="{{ route('projects.delete', [app()->getLocale(), $project->slug]) }}">{{ __('Delete') }}</a>
                </div>
                <div class="col-6">
                  <a href="#" class="btn btn-light btn-block" data-dismiss="modal">{{ __('Cancel') }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection
@section('scripts')
<script>
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    console.log(e)
    history.pushState(null, null, location.pathname + '?tab=' + $(e.target).attr("href").replace('#', ''))
  });
</script>
@endsection
