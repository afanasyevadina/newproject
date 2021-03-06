@extends('layouts.app')
@section('head-scripts')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
<div class="container py-5">
	<form class="row" action="{{ route('notes.create', [app()->getLocale(), $project->id]) }}" method="POST" autocomplete="off">
		@csrf
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header">{{ __('New note') }}</div>

				<div class="card-body">
					<div class="row">                    	
						<div class="col-12 form-group">
							{{ __('Project') }}: {{ $project->title }}
						</div>
						<div class="col-12 form-group">
							<label>{{ __('Title') }}</label>
							<input type="text" class="form-control" name="title" required placeholder="{{ __('Title') }}">
						</div>
						<div class="col-12 form-group">
							<textarea id="editor" name="text"></textarea>
						</div>
						<div class="col-12 d-flex justify-content-end">
							<button class="btn btn-lg btn-primary">{{ __('Save') }}</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
@section('scripts')
<script src="/js/ckeditor.js"></script>
<script>
	document.body.onload = initEditor
</script>
@endsection