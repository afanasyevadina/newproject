@extends('layouts.app')

@section('content')
<div class="bg-light py-5 shadow">
  <div class="container">
    <div class="d-flex align-items-start flex-wrap">
      <img srcset="{{ $user->avatar }}, {{ config('app.avatar') }}" alt="" height="100" width="100" class="img-cover rounded-circle">
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
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a href="#main" class="nav-link {{ !\Request::get('tab') || \Request::get('tab') == 'main' ? 'active' : '' }}" data-toggle="tab">{{ __('Main') }}</a>
    </li>
    <li class="nav-item">
      <a href="#articles" class="nav-link {{ \Request::get('tab') == 'articles' ? 'active' : '' }}" data-toggle="tab">{{ __('Articles') }}</a>
    </li>
    <li class="nav-item">
      <a href="#projects" class="nav-link {{ \Request::get('tab') == 'projects' ? 'active' : '' }}" data-toggle="tab">{{ __('Projects') }}</a>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade py-4 {{ !\Request::get('tab') || \Request::get('tab') == 'main' ? 'active show' : '' }}" id="main">
      <div class="mb-4">
        <small class="d-block mb-2">{{ __('About') }} {{ @explode(' ', $user->name)[0] }}:</small>
        {{ nl2br($user->about) }}
      </div>
      <div class="mb-4">
        <small class="d-block mb-2">{{ __('Interests') }}:</small>
        {{ $user->interests->pluck('name')->implode(', ') }}
      </div>
      <div class="mb-4">
        <small class="d-block mb-2">{{ __('Skills') }}:</small>
        {{ $user->skills->pluck('name')->implode(', ') }}
      </div>
      <div class="mb-4">
        <small class="d-block mb-2">{{ __('Goals') }}:</small>
        {{ $user->goals->pluck('name')->implode(', ') }}
      </div>
    </div>
    <div class="tab-pane fade py-4 {{ \Request::get('tab') == 'projects' ? 'active show' : '' }}" id="projects">
      <div class="row">
        @foreach($user->projects()->withCount('likes')->withCount('dislikes')->withCount('comments')->get() as $project)
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
    <div class="tab-pane fade py-4 {{ \Request::get('tab') == 'articles' ? 'active show' : '' }}" id="articles">
      @foreach($user->articles()->withCount('likes')->withCount('dislikes')->withCount('comments')->get() as $article)
      <div class="card shadow">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between mb-2">
            <a href="{{ route('blog.view', [app()->getLocale(), $article->slug]) }}" class="text-dark">
              <h3 class="m-0">{{ $article->title }}</h3>
            </a>
            @if($article->user->id == \Auth::id())
            <div class="dropdown">
              <button class="btn" id="dropdownBlog" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="/images/icons/more.svg" alt=""/>
              </button>
              <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownBlog">
                <a class="dropdown-item" href="{{ route('blog.edit', [app()->getLocale(), $article->slug]) }}">{{ __('Edit') }}</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{ $article->id }}">{{ __('Delete') }}</a>
              </div>
            </div>
            @endif      
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
      @endforeach
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="/js/subscription.js"></script>
<script>
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    history.pushState(null, null, location.pathname + '?tab=' + $(e.target).attr("href").replace('#', ''))
  });
</script>
@endsection