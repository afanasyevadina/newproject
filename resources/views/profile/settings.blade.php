@extends('layouts.app')

@section('content')
<div class="container">
	<form class="row" action="{{ route('profile.settings', app()->getLocale()) }}" method="POST" autocomplete="off">
		@csrf
		<div class="col-md-4 col-xl-3">
			<div class="position-relative overflow-hidden avatar-area">
				<div class="img-rel img-rel-100">
					<img src="" alt="" id="preview" hidden>
					<img srcset="{{ $user->avatar }}, {{ config('app.avatar') }}" alt="" id="image">
				</div>
				<div class="d-flex position-absolute t-0 r-0 l-0 b-0 align-items-center justify-content-center icon">
					<img src="/images/icons/image.png" alt="" height="50">
				</div>
				<input type="file" accept="image/*" id="avatar" class="fade position-absolute t-0 l-0 r-0 b-0 c-pointer">
				<input type="hidden" name="avatar" id="avatar-data" value="{{ $user->avatar }}" data-value="{{ $user->avatar }}">
			</div>
		</div>
		<div class="col-md-8 col-xl-9">
			<div class="card mb-4">
				<div class="card-header">{{ __('Main information') }}</div>

				<div class="card-body">
					<div class="row">                    	
						<div class="col-12 form-group">
							<label>{{ __('Name') }}</label>
							<input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
						</div>
						<div class="col-12 form-group">
							<label>{{ __('Email') }}</label>
							<input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
						</div>
						<div class="col-sm-6 form-group">
							<label>{{ __('Gender') }}</label>
							<select name="gender" class="form-control">
								<option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>{{ __('Male') }}</option>
								<option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>{{ __('Female') }}</option>
							</select>
						</div>
						<div class="col-sm-6 form-group">
							<label>{{ __('Date of birth') }}</label>
							<input type="date" name="born" class="form-control" value="{{ $user->born }}">
						</div>
						<div class="col-12 form-group">
							<label>{{ __('About me') }}</label>
							<textarea name="about" rows="5" class="form-control">{{ $user->about }}</textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="card mb-4">
				<div class="card-header">{{ __('Areas of activity') }}</div>

				<div class="card-body">
					<label class="mb-3">{{ __('Interests') }}</label>
					<div class="row">
						@foreach($categories as $category)
						<div class="col-6 col-lg-4">
							<label>
								<input type="checkbox" name="interests[]" value="{{ $category->id }}" {{ $user->interests->pluck('id')->contains($category->id) ? 'checked' : '' }}>
								{{ $category->name }}
							</label>
						</div>
						@endforeach
					</div>
					<hr>
					<label class="mb-3">{{ __('Skills') }}</label>
					<div class="row">
						@foreach($categories as $category)
						<div class="col-6 col-lg-4">
							<label>
								<input type="checkbox" name="skills[]" value="{{ $category->id }}" {{ $user->skills->pluck('id')->contains($category->id) ? 'checked' : '' }}>
								{{ $category->name }}
							</label>
						</div>
						@endforeach
					</div>
					<hr>
					<label class="mb-3">{{ __('Goals') }}</label>
					<div class="row">
						@foreach($categories as $category)
						<div class="col-6 col-lg-4">
							<label>
								<input type="checkbox" name="goals[]" value="{{ $category->id }}" {{ $user->goals->pluck('id')->contains($category->id) ? 'checked' : '' }}>
								{{ $category->name }}
							</label>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-end">
				<button class="btn btn-primary">{{ __('Save') }}</button>
			</div>
		</div>
	</form>
</div>
@endsection
@section('scripts')
<script>
	document.getElementById('avatar').onchange = function() {
		document.getElementById('preview').hidden = true
		document.getElementById('image').hidden = false
		document.getElementById('avatar-data').value = document.getElementById('avatar-data').dataset.value
		if(this.files && this.files[0]) {
			var reader = new FileReader()
			reader.onload = e => {
				document.getElementById('preview').hidden = false
				document.getElementById('image').hidden = true
				document.getElementById('preview').src = e.target.result
				document.getElementById('avatar-data').value = e.target.result
			}
			reader.readAsDataURL(this.files[0])
		}
	}
</script>
@endsection
