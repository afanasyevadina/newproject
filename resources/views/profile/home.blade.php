@extends('layouts.app')

@section('content')
<div class="bg-light py-5 shadow">
  <div class="container">
    <div class="d-flex align-items-start flex-wrap">
      <img srcset="{{ \Auth::user()->avatar }}, {{ config('app.avatar') }}" alt="{{ \Auth::user()->name }}" height="100" width="100" class="img-cover rounded-circle">
      <div class="ml-3 ml-md-4">
        <h1 class="mb-4">{{ \Auth::user()->name }}</h1>
        <div class="d-flex flex-wrap">
          <div class="text-secondary mr-4 mb-2">
            <h5 class="mb-0">{{ \Auth::user()->subscribers()->count() }}</h5>
            <div>{{ __('subscribers') }}</div>
          </div>
          <div class="text-secondary mr-4 mb-2">
            <h5 class="mb-0">{{ \Auth::user()->subscriptions()->count() }}</h5>
            <div>{{ __('subscriptions') }}</div>
          </div>
          <div class="text-secondary mr-4 mb-2">
            <h5 class="mb-0">{{ \Auth::user()->projects()->count() }}</h5>
            <div>{{ __('projects') }}</div>
          </div>
          <div class="text-secondary mb-2">
            <h5 class="mb-0">{{ \Auth::user()->articles()->count() }}</h5>
            <div>{{ __('articles') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container py-5">
  <div class="card shadow bg-light mb-4">
    <div class="card-body">
      <h3 class="mb-4">{{ __('About') }} {{ @explode(' ', \Auth::user()->name)[0] }}:</h3>
      <h5>{{ nl2br(\Auth::user()->about) }}</h5>
      <hr>
      <div class="row">
        <div class="col-md-4 mb-4">
          <h5 class="mb-3">{{ __('Interests') }}:</h5>
          @if(\Auth::user()->interests->count())
          {{ \Auth::user()->interests->pluck('name')->map(function($v) { return '#'.$v; })->implode(', ') }}
          @else
          <span class="text-muted">{{ __('Not specified') }}</span>
          @endif
        </div>
        <div class="col-md-4 mb-4">
          <h5 class="mb-3">{{ __('Skills') }}:</h5>
          @if(\Auth::user()->skills->count())
          {{ \Auth::user()->skills->pluck('name')->map(function($v) { return '#'.$v; })->implode(', ') }}
          @else
          <span class="text-muted">{{ __('Not specified') }}</span>
          @endif
        </div>
        <div class="col-md-4 mb-4">
          <h5 class="mb-3">{{ __('Goals') }}:</h5>
          @if(\Auth::user()->goals->count())
          {{ \Auth::user()->goals->pluck('name')->map(function($v) { return '#'.$v; })->implode(', ') }}
          @else
          <span class="text-muted">{{ __('Not specified') }}</span>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="card bg-light shadow mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h3 class="mb-4">{{ __('Projects') }}</h3>
        <a href="{{ route('projects.create', app()->getLocale()) }}" class="btn btn-success mb-4">{{ __('Start new project') }}</a>
      </div>
      <div class="row">
        @forelse(\Auth::user()->projects()->withCount('likes')->withCount('dislikes')->withCount('comments')->get() as $project)
        <div class="col-lg-4 col-sm-6 mb-4">
          <div class="card h-100">
            <a href="{{ route('projects.view', [app()->getLocale(), $project->slug]) }}" class="card-body text-dark text-decoration-none">
              <h3 class="mb-2">{{ $project->title }}</h3>
              <small class="d-block text-muted mb-4">{{ $project->user->name }}, {{ $project->date }}</small>
              <p>{!! nl2br($project->subtitle) !!}</p>
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
        @empty
        <div class="text-muted col-12">{{ __('No projects yet') }}</div>
        @endforelse
      </div>
    </div>
  </div>
  <div class="card shadow bg-light mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h3 class="mb-4">{{ __('Articles') }}</h3>
        <a href="{{ route('blog.create', app()->getLocale()) }}" class="btn btn-success mb-4">{{ __('Share your thoughts') }}</a>
      </div>
      @forelse(\Auth::user()->articles()->withCount('likes')->withCount('dislikes')->withCount('comments')->get() as $article)
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between mb-2">
            <a href="{{ route('blog.view', [app()->getLocale(), $article->slug]) }}" class="text-dark">
              <h3 class="m-0">{{ $article->title }}</h3>
            </a>
            <div class="dropdown">
              <button class="btn" id="dropdownBlog" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="/images/icons/more.svg" alt="More"/>
              </button>
              <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownBlog">
                <a class="dropdown-item" href="{{ route('blog.edit', [app()->getLocale(), $article->slug]) }}">{{ __('Edit') }}</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{ $article->id }}">{{ __('Delete') }}</a>
              </div>
            </div>
          </div>
          <small class="d-block text-muted mb-4">{{ $article->user->name }}, {{ $article->date }}</small>
          <p>{!! nl2br($article->subtitle) !!}</p>
          <div class="d-flex flex-wrap">
            @foreach($article->categories as $category)
            <a href="{{ route('blog', [app()->getLocale(), 'cat' => $category->slug]) }}" class="mr-3">
              #{{ $category->name }}
            </a>
            @endforeach
          </div>
        </div>
        <div class="card-footer bg-white d-flex justify-content-between">
          <div class="d-flex">
            <div class="c-pointer d-flex align-items-center mr-4 like-btn" data-href="{{ route('blog.like', $article->id) }}" data-likes=".likes-count{{ $article->id }}" data-dislikes=".dislikes-count{{ $article->id }}">
              <span class="mr-1 likes-count{{ $article->id }}">{{ $article->likes_count }}</span>
              <span class="text-success">+</span>
            </div>
            <div class="c-pointer d-flex align-items-center like-btn" data-href="{{ route('blog.dislike', $article->id) }}" data-likes=".likes-count{{ $article->id }}" data-dislikes=".dislikes-count{{ $article->id }}">
              <span class="mr-1 dislikes-count{{ $article->id }}">{{ $article->dislikes_count }}</span>
              <span class="text-danger">-</span>
            </div>
          </div>
          <small class="text-dark">{{ $article->comments_count }} {{ __('comments') }}</small>
        </div>
      </div>
      <div class="modal fade" id="delete{{ $article->id }}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center p-5">
              <h3 class="t-l_b-24 mb-4">{{ __('Delete article') }}?</h3>
              <div class="row">
                <div class="col-6">
                  <a class="btn btn-secondary btn-block" href="{{ route('blog.delete', [app()->getLocale(), $article->slug]) }}">{{ __('Delete') }}</a>
                </div>
                <div class="col-6">
                  <a href="#" class="btn btn-light btn-block" data-dismiss="modal">{{ __('Cancel') }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="text-muted">{{ __('No articles yet') }}</div>
      @endforelse
    </div>
  </div>
</div>
@endsection