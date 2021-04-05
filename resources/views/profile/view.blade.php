@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>{{ $user->name }}</h1>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="" class="nav-link active" data-toggle="tab" data-target="#main">{{ __('Main') }}</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link" data-toggle="tab" data-target="#articles">{{ __('Articles') }}</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link" data-toggle="tab" data-target="#projects">{{ __('Projects') }}</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="main">main</div>
        <div class="tab-pane fade" id="projects">projects</div>
        <div class="tab-pane fade" id="articles">articles</div>
    </div>
</div>
@endsection
