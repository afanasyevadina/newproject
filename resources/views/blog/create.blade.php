@extends('layouts.app')
@section('head-scripts')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
<div class="container py-5">
	<form class="row" action="{{ route('blog.create', app()->getLocale()) }}" method="POST" autocomplete="off">
		@csrf
		<div class="col-12">
			<div class="card mb-4 shadow">
				<div class="card-header">{{ __('New article') }}</div>

				<div class="card-body">
					<div class="row">                    	
						<div class="col-12 form-group">
							<label>{{ __('Title') }}</label>
							<input type="text" class="form-control" name="title" required>
						</div>
						<div class="col-12 form-group">
							<label>{{ __('Subtitle') }}</label>
							<textarea name="subtitle" rows="5" class="form-control"></textarea>
						</div>
						<div class="col-12 form-group">
							<textarea id="editor" name="content"></textarea>
						</div>
						<div class="col-12 form-group">
							<label class="mb-3">{{ __('Tags') }}</label>
							<div class="row">
								@foreach($categories as $category)
								<div class="col-6 col-lg-4">
									<label>
										<input type="checkbox" name="categories[]" value="{{ $category->id }}">
										{{ $category->name }}
									</label>
								</div>
								@endforeach
							</div>
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