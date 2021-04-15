@extends('layouts.app')

@section('content')
<div class="bg-light py-5 shadow">
  <div class="container">
    <div class="d-sm-flex align-items-start justify-content-center justify-content-sm-between">
      <h1 class="mb-4 mb-md-0">{{ __('Blog') }}</h1>
      <a href="{{ route('blog.create', app()->getLocale()) }}" class="btn btn-success btn-lg">{{ __('Share your thoughts') }}</a>
    </div>
  </div>
</div>
<div class="container py-5">
  @foreach($articles as $article)
  <div class="card shadow">
    <div class="card-body">
      <div class="d-flex align-items-start justify-content-between mb-2">
        <a href="{{ route('blog.view', [app()->getLocale(), $article->slug]) }}" class="text-dark">
          <h3 class="m-0">{{ $article->title }}</h3>
        </a>
        @if($article->user->id == \Auth::id())
        <div class="dropdown">
          <button class="btn" id="dropdownBlog" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="/images/icons/more.svg" alt="More"/>
          </button>
          <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownBlog">
            <a class="dropdown-item" href="{{ route('blog.edit', [app()->getLocale(), $article->slug]) }}">{{ __('Edit') }}</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{ $article->id }}">{{ __('Delete') }}</a>
          </div>
        </div>
        @endif      
      </div>
      <small class="d-block text-muted mb-4">
        <a href="{{ route('profile.view', [app()->getLocale(), $article->user->slug]) }}" class="text-dark">{{ $article->user->name }}</a>
        , {{ $article->date }}
      </small>
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
@endsection
@section('scripts')
<script src="/js/likes.js"></script>
@endsection