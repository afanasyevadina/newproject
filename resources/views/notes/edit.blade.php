@extends('layouts.app')
@section('head-scripts')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
<div class="container py-5">
	<form class="row" action="{{ route('notes.create', [app()->getLocale(), $note->id]) }}" method="POST" autocomplete="off">
		@csrf
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header">{{ __('Edit note') }}</div>

				<div class="card-body">
					<div class="row">                    	
						<div class="col-12 form-group">
							{{ __('Project') }}: {{ $note->commentable->title }}
						</div>
						<div class="col-12 form-group">
							<label>{{ __('Title') }}</label>
							<input type="text" class="form-control" name="title" required placeholder="{{ __('Title') }}" value="{{ $note->title }}">
						</div>
						<div class="col-12 form-group">
							<textarea id="editor" name="text">{{ $note->text }}</textarea>
						</div>
						<div class="col-12 d-flex justify-content-end">
							<button type="button" class="btn btn-lg btn-secondary mr-3" data-toggle="modal" data-target="#delete">{{ __('Delete') }}</button>
							<button class="btn btn-lg btn-primary">{{ __('Save') }}</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
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
@section('scripts')
<script src="/js/ckeditor.js"></script>
<script>
	document.body.onload = initEditor
</script>
@endsection