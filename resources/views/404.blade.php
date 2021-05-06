@extends('layouts.app')

@section('content')
<div class="bg-light py-5 shadow vh-70">
	<div class="container py-5">
		<h1 class="mb-5">404 Not Found</h1>
		<a href="{{ route('home', app()->getLocale()) }}" class="btn btn-lg btn-primary">{{ __('Back to home') }}</a>
	</div>
</div>
@endsection
