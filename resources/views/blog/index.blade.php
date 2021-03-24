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
    		<a href="{{ route('blog.view', [app()->getLocale(), $article->slug]) }}" class="text-dark">
    			<h3 class="mb-4">{{ $article->title }}</h3>
    		</a>
    		<p class="mb-0">{!! $article->subtitle !!}</p>
    	</div>
    	<div class="card-footer bg-white d-flex justify-content-between">
    		<a href="{{ route('profile.view', [app()->getLocale(), $article->user->slug]) }}" class="text-dark d-flex">
    			<small>{{ $article->user->name }}</small>
    		</a>
    		<small class="text-dark">{{ $article->date }}</small>
    	</div>
    </div>
    @endforeach
</div>
@endsection
