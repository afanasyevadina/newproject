@extends('layouts.app')
@section('content')
<div class="container">
	<div class="d-flex align-items-start justify-content-between">
		<div>
			<h1 class="mb-4">{{ $note->title }}</h1>
			<p class="mb-5">{{ __('Project') }}: {{ $note->commentable->title }}</p>
		</div>
		@if($note->user->id == \Auth::id())
		<div class="dropdown">
			<button class="btn" id="dropdownBlog" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src="/images/icons/more.svg" alt=""/>
			</button>
			<div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownBlog">
				<a class="dropdown-item t-r_r-14" href="{{ route('notes.edit', [app()->getLocale(), $note->slug]) }}">{{ __('Edit') }}</a>
				<a class="dropdown-item t-r_r-14" href="#" data-toggle="modal" data-target="#delete">{{ __('Delete') }}</a>
			</div>
		</div>
		@endif 
	</div>
	<div class="from-cke">{!! $note->text !!}</div>
</div>
<div class="modal fade" id="delete">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body text-center p-5">
				<h3 class="t-l_b-24 mb-4">{{ __('Delete note') }}?</h3>
				<div class="row">
					<div class="col-6">
						<a class="btn btn-secondary btn-block" href="{{ route('notes.delete', [app()->getLocale(), $note->slug]) }}">{{ __('Delete') }}</a>
					</div>
					<div class="col-6">
						<a href="#" class="btn btn-light btn-block" data-dismiss="modal">{{ __('Cancel') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
