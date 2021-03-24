@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">{{ $article->title }}</h1>
    <p class="mb-5">{!! $article->subtitle !!}</p>
    <div>{!! $article->content !!}</div>
</div>
@endsection
