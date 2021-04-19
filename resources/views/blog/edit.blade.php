@extends('layouts.app')
@section('head-scripts')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
<div class="container py-5">
	<form class="row" action="{{ route('blog.edit', [app()->getLocale(), $article->slug]) }}" method="POST" autocomplete="off">
		@csrf
		<div class="col-12">
			<div class="card mb-4 shadow">
				<div class="card-header">{{ __('Edit article') }}</div>

				<div class="card-body">
					<div class="row">                    	
						<div class="col-12 form-group">
							<label>{{ __('Title') }}</label>
							<input type="text" class="form-control" name="title" required placeholder="{{ __('Title') }}" value="{{ $article->title }}">
						</div>
						<div class="col-12 form-group">
							<label>{{ __('Subtitle') }}</label>
							<textarea name="subtitle" rows="5" class="form-control" placeholder="{{ __('Short description') }}">{{ $article->subtitle }}</textarea>
						</div>
						<div class="col-12 form-group">
							<textarea id="editor" name="content">{{ $article->content }}</textarea>
						</div>
						<div class="col-12 form-group">
							<label class="mb-3">{{ __('Tags') }}</label>
							<div class="row">
								@foreach($categories as $category)
								<div class="col-6 col-lg-4">
									<label>
										<input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ $article->categories->pluck('id')->contains($category->id) ? 'checked' : '' }}>
										{{ $category->name }}
									</label>
								</div>
								@endforeach
							</div>
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
@endsection
@section('scripts')
<script src="/js/ckeditor.js"></script>
<script>
	document.body.onload = initEditor
</script>
@endsection