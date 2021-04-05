@extends('layouts.app')

@section('content')
<div class="container">
  <div class="jumbotron">
    <h1 class="mb-5">{{ __('Blog') }}</h1>
    <a href="{{ route('blog.create', app()->getLocale()) }}" class="btn btn-success btn-lg">{{ __('Share your thoughts') }}</a>
  </div>
  @foreach($articles as $article)
  <div class="card">
    <div class="card-body mb-4">
      <div class="d-flex align-items-start justify-content-between">
        <a href="{{ route('blog.view', [app()->getLocale(), $article->slug]) }}" class="text-dark">
          <h3 class="mb-4">{{ $article->title }}</h3>
        </a>
        @if($article->user->id == \Auth::id())
        <div class="dropdown">
          <button class="btn" id="dropdownBlog" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="/images/icons/more.svg" alt=""/>
          </button>
          <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownBlog">
            <a class="dropdown-item t-r_r-14" href="{{ route('blog.edit', [app()->getLocale(), $article->slug]) }}">{{ __('Edit') }}</a>
            <a class="dropdown-item t-r_r-14" href="#" data-toggle="modal" data-target="#delete{{ $article->id }}">{{ __('Delete') }}</a>
          </div>
        </div>
        @endif      
      </div>
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
      <a href="{{ route('profile.view', [app()->getLocale(), $article->user->slug]) }}" class="text-dark d-flex">
        <small>{{ $article->user->name }}</small>
      </a>
      <small class="text-dark">{{ $article->date }}</small>
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
