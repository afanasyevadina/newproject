@extends('layouts.app')

@section('content')
<div class="bg-light py-4 py-sm-5 shadow mb-5">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<h1 class="mb-4">{{ config('app.name') }}</h1>
				<p class="mb-4 mb-md-5 h5">{{ __('If you want to learn something new - start your project.') }}</p>
				<div class="row">
					<div class="col-sm-6">
						<a href="{{ route('projects', app()->getLocale()) }}" class="btn btn-success btn-lg btn-block mb-2 mb-sm-0">
							{{ __('Start now') }}
						</a>
					</div>
					<div class="col-sm-6">
						<a href="#about" class="btn btn-primary btn-lg btn-block">
							{{ __('Learn more') }}
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6 text-center d-none d-sm-block">
				<img src="/images/logo.png" alt="" class="img-fluid">
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row align-items-center mb-4">
		<div class="col-sm-6">
			<p class="h3 mb-4">{{ __('For beginners') }}</p>
			<p class="h6 mb-4">{{ __('Community support keeps you motivated and helps you find new ideas.') }}</p>
		</div>
		<div class="col-sm-6 text-center">
			<img src="/images/beginner.jpg" alt="" class="w-100">
		</div>
	</div>
	<div class="row align-items-center mb-5 flex-column-reverse flex-sm-row">
		<div class="col-sm-6 text-center">
			<img src="/images/expert.jpg" alt="" class="w-100">
		</div>
		<div class="col-sm-6">
			<div class="pl-lg-5">
				<p class="h3 mb-4">{{ __('For experts') }}</p>
				<p class="h6 mb-4">{{ __('Share your experience and gain even more.') }}</p>
			</div>
		</div>
	</div>
</div>
<div class="bg-info py-5">
	<div class="container" id="about">
		<div class="row">
			<div class="col-12 mb-4">
				<h2 class="text-center text-white">{{ __('What is this?') }}</h2>
			</div>
			<div class="col-md-4 mb-3">
				<div class="card h-100 shadow">
					<div class="card-body">
						<p class="h4 mb-2">{{ __('Learn new') }}</p>
						<p>{{ __('Specify your learning goals, create projects, and get support') }}</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="card h-100 shadow">
					<div class="card-body">
						<p class="h4 mb-2">{{ __('Share experience') }}</p>
						<p>{{ __('Tell us what you are an expert at, upgrade your skills and find students') }}</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="card h-100 shadow">
					<div class="card-body">
						<p class="h4 mb-2">{{ __('Join the community') }}</p>
						<p>{{ __('Read and blogs, see projects, participate in discussions and communicate with your interests') }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="bg-light py-5">
	<div class="container">
		<div class="text-center">
			<p class="h3 mb-4">{{ __('As Confucius said') }}:</p>
			<div class="mb-4">{{ __('Tell me - and I will forget, show me - and I will remember, Let me do - and I will understand!') }}</div>
			<small class="text-secondary"><i>{{ __('And he said sensible things!') }}</i></small>
		</div>
	</div>
</div>
@endsection
