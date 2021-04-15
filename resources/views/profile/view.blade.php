@extends('layouts.app')

@section('content')
<div class="bg-light py-5 shadow">
  <div class="container">
    <div class="d-flex align-items-start flex-wrap">
      <img srcset="{{ $user->avatar }}, {{ config('app.avatar') }}" alt="{{ $user->name }}" height="100" width="100" class="img-cover rounded-circle">
      <div class="ml-3 ml-md-4">
        <h1 class="mb-4">{{ $user->name }}</h1>
        <div class="d-flex flex-wrap mb-3">
          <div class="text-secondary mr-4 mb-2">
            <h5 class="mb-0">{{ $user->subscribers()->count() }}</h5>
            <div>{{ __('subscribers') }}</div>
          </div>
          <div class="text-secondary mr-4 mb-2">
            <h5 class="mb-0">{{ $user->subscriptions()->count() }}</h5>
            <div>{{ __('subscriptions') }}</div>
          </div>
          <div class="text-secondary mr-4 mb-2">
            <h5 class="mb-0">{{ $user->projects()->count() }}</h5>
            <div>{{ __('projects') }}</div>
          </div>
          <div class="text-secondary mb-2">
            <h5 class="mb-0">{{ $user->articles()->count() }}</h5>
            <div>{{ __('articles') }}</div>
          </div>
        </div>
        <button class="btn btn-lg btn-success subscribe-btn unsubscribed" data-href="{{ route('subscribe', $user->id) }}" {{ $user->subscription ? 'hidden' : '' }} data-subscribed=".subscribed" data-unsubscribed=".unsubscribed">{{ __('Subscribe') }}</button>
        <button class="btn btn-lg btn-secondary subscribe-btn subscribed" data-href="{{ route('unsubscribe', $user->id) }}" {{ $user->subscription ? '' : 'hidden' }} data-subscribed=".subscribed" data-unsubscribed=".unsubscribed">{{ __('Unsubscribe') }}</button>
      </div>
    </div>
  </div>
</div>
<div class="container py-5">
  <div class="card shadow bg-light mb-4">
    <div class="card-body">
      <h3 class="mb-4">{{ __('About') }} {{ @explode(' ', $user->name)[0] }}:</h3>
      <h5>{{ nl2br($user->about) }}</h5>
      <hr>
      <div class="row">
        <div class="col-md-4 mb-4">
          <h5 class="mb-3">{{ __('Interests') }}:</h5>
          {{ $user->interests->pluck('name')->map(function($v) { return '#'.$v; })->implode(', ') }}
        </div>
        <div class="col-md-4 mb-4">
          <h5 class="mb-3">{{ __('Skills') }}:</h5>
          {{ $user->skills->pluck('name')->map(function($v) { return '#'.$v; })->implode(', ') }}
        </div>
        <div class="col-md-4 mb-4">
          <h5 class="mb-3">{{ __('Goals') }}:</h5>
          {{ $user->goals->pluck('name')->map(function($v) { return '#'.$v; })->implode(', ') }}
        </div>
      </div>
    </div>
  </div>
  <div class="card bg-light shadow mb-4">
    <div class="card-body">
      <h3 class="mb-4">{{ __('Projects') }}</h3>
      <div class="row">
        @foreach($user->projects()->withCount('likes')->withCount('dislikes')->withCount('comments')->get() as $project)
        <div class="col-lg-4 col-sm-6 mb-4">
          <div class="card h-100">
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
  </div>
  <div class="card shadow bg-light mb-4">
    <div class="card-body">
      <h3 class="mb-4">{{ __('Articles') }}</h3>
      @foreach($user->articles()->withCount('likes')->withCount('dislikes')->withCount('comments')->get() as $article)
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between mb-2">
            <a href="{{ route('blog.view', [app()->getLocale(), $article->slug]) }}" class="text-dark">
              <h3 class="m-0">{{ $article->title }}</h3>
            </a>
          </div>
          <small class="d-block text-muted mb-4">{{ $article->user->name }}, {{ $article->date }}</small>
          <p>{!! $article->subtitle !!}</p>
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
      @endforeach
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="/js/subscription.js"></script>
@endsection