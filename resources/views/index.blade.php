@extends('layouts.app')

@section('content')
<div class="bg-light py-5 shadow mb-5">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<h1 class="mb-4">{{ config('app.name') }}</h1>
				<h5 class="mb-5">Хочешь изучить новое – начни свой проект.</h5>
				<div class="row">
					<div class="col-6">
						<a href="{{ route('projects', app()->getLocale()) }}" class="btn btn-success btn-lg btn-block">
							{{ __('Start now') }}
						</a>
					</div>
					<div class="col-6">
						<a href="#about" class="btn btn-primary btn-lg btn-block">
							{{ __('Learn more') }}
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6 text-center">
				<img src="/images/logo.png" alt="" class="img-fluid">
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row align-items-center mb-4">
		<div class="col-sm-6">
			<h3 class="mb-4">{{ __('For beginners') }}</h3>
			<h6 class="mb-4">Поддержка сообщества сохраняет мотивацию и помогает найти новые идеи.</h6>
		</div>
		<div class="col-sm-6 text-center">
			<img src="/images/beginner.jpg" alt="" class="w-100">
		</div>
	</div>
	<div class="row align-items-center mb-5">
		<div class="col-sm-6 text-center">
			<img src="/images/expert.jpg" alt="" class="w-100">
		</div>
		<div class="col-sm-6">
			<div class="pl-lg-5">
				<h3 class="mb-4">{{ __('For experts') }}</h3>
				<h6 class="mb-4">Поделись опытом и приобретешь еще больше.</h6>
			</div>
		</div>
	</div>
</div>
<div class="bg-info py-5">
	<div class="container">
		<div class="row">
			<div class="col-12 mb-4">
				<h2 class="text-center text-white">{{ __('What is this?') }}</h2>
			</div>
			<div class="col-md-4 mb-3">
				<div class="card h-100 shadow">
					<div class="card-body">
						<h4 class="mb-2">{{ __('Learn new') }}</h4>
						<p>Указывайте свои цели в обучении, создавайте проекты и получайте поддержку</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="card h-100 shadow">
					<div class="card-body">
						<h4 class="mb-2">{{ __('Share experience') }}</h4>
						<p>Расскажите, в чем вы эксперт, прокачивайте навыки и находите студентов</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="card h-100 shadow">
					<div class="card-body">
						<h4 class="mb-2">{{ __('Join the community') }}</h4>
						<p>Читайте и блоги, смотрите проекты, участвуйте в обуждении и общайтесь по интересам</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="bg-light py-5">
	<div class="container">
		<div class="text-center">
			<h3 class="mb-4">Как говорил Конфуций:</h3>
			<div class="mb-4">Скажи мне — и я забуду, покажи мне — и я запомню, Дай мне сделать — и я пойму!</div>
			<small class="text-secondary"><i>А он говорил дельные вещи!</i></small>
		</div>
	</div>
</div>
@endsection
