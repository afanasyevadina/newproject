@extends('layouts.app')

@section('content')
<div class="bg-light py-5">
	<div class="container">
		<h1>{{ __('On request') }} "{{ \Request::get('q') }}" {{ __('found') }}:</h1>
	</div>
</div>
<div class="container py-5">
	<ul class="nav nav-tabs mb-4">
		<li class="nav-item">
			<a href="#projects" class="nav-link {{ !\Request::get('tab') || \Request::get('tab') == 'projects' ? 'active' : '' }}" data-toggle="tab">{{ __('Projects') }}</a>
		</li>
		<li class="nav-item">
			<a href="#articles" class="nav-link {{ \Request::get('tab') == 'articles' ? 'active' : '' }}" data-toggle="tab">{{ __('Articles') }}</a>
		</li>
		<li class="nav-item">
			<a href="#people" class="nav-link {{ \Request::get('tab') == 'people' ? 'active' : '' }}" data-toggle="tab">{{ __('People') }}</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade {{ !\Request::get('tab') || \Request::get('tab') == 'projects' ? 'active show' : '' }}" id="projects">
			<h1 class="mb-4">{{ __('Projects') }}</h1>
			<div class="row">
				@foreach($projects as $project)
				<div class="col-lg-4 col-sm-6">
					<div class="card h-100 shadow">
						<a href="{{ route('projects.view', [app()->getLocale(), $project->slug]) }}" class="card-body text-dark text-decoration-none">
							<h3 class="mb-2">{{ $project->title }}</h3>
							<small class="d-block text-muted mb-4">{{ $project->user->name }}, {{ $project->date }}</small>
							<p>{!! $project->subtitle !!}</p>
							<div class="d-flex flex-wrap">
								@foreach($project->categories as $category)
								<div class="mr-3 text-primary">
									#{{ $category->name }}
								</div>
								@endforeach
							</div>
						</a>
						<div class="card-footer bg-white d-flex justify-content-between">
							<div class="d-flex">
								<div class="c-pointer d-flex align-items-center mr-4 like-btn" data-href="{{ route('project.like', $project->id) }}" data-likes=".likes-count{{ $project->id }}" data-dislikes=".dislikes-count{{ $project->id }}">
									<span class="mr-1 likes-count{{ $project->id }}">{{ $project->likes_count }}</span>
									<span class="text-success">+</span>
								</div>
								<div class="c-pointer d-flex align-items-center like-btn" data-href="{{ route('project.dislike', $project->id) }}" data-likes=".likes-count{{ $project->id }}" data-dislikes=".dislikes-count{{ $project->id }}">
									<span class="mr-1 dislikes-count{{ $project->id }}">{{ $project->dislikes_count }}</span>
									<span class="text-danger">-</span>
								</div>
							</div>
							<small class="text-dark">{{ $project->comments_count }} {{ __('comments') }}</small>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		<div class="tab-pane fade {{ \Request::get('tab') == 'articles' ? 'active show' : '' }}" id="articles">
			<h1 class="mb-4">{{ __('Articles') }}</h1>
			@foreach($articles as $article)
			<div class="card shadow">
				<div class="card-body">
					<div class="d-flex align-items-start justify-content-between mb-2">
						<a href="{{ route('blog.view', [app()->getLocale(), $article->slug]) }}" class="text-dark">
							<h3 class="m-0">{{ $article->title }}</h3>
						</a>
						@if($article->user->id == \Auth::id())
						<div class="dropdown">
							<button class="btn" id="dropdownBlog" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="/images/icons/more.svg" alt="More"/>
							</button>
							<div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownBlog">
								<a class="dropdown-item" href="{{ route('blog.edit', [app()->getLocale(), $article->slug]) }}">{{ __('Edit') }}</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{ $article->id }}">{{ __('Delete') }}</a>
							</div>
						</div>
						@endif      
					</div>
					<small class="d-block text-muted mb-4">
						<a href="{{ route('profile.view', [app()->getLocale(), $article->user->slug]) }}" class="text-dark">{{ $article->user->name }}</a>
						, {{ $article->date }}
					</small>
					<p>{!! $article->subtitle !!}</p>
					<div class="d-flex flex-wrap">
						@foreach($article->categories as $category)
						<a href="{{ route('blog', [app()->getLocale(), 'cat' => $category->slug]) }}" class="mr-3">
							#{{ $category->name }}
						</a>
						@endforeach
					</div>
				</div>
				<div class="card-footer bg-white d-flex justify-content-between">
					<div class="d-flex">
						<div class="c-pointer d-flex align-items-center mr-4 like-btn" data-href="{{ route('blog.like', $article->id) }}" data-likes=".likes-count{{ $article->id }}" data-dislikes=".dislikes-count{{ $article->id }}">
							<span class="mr-1 likes-count{{ $article->id }}">{{ $article->likes_count }}</span>
							<span class="text-success">+</span>
						</div>
						<div class="c-pointer d-flex align-items-center like-btn" data-href="{{ route('blog.dislike', $article->id) }}" data-likes=".likes-count{{ $article->id }}" data-dislikes=".dislikes-count{{ $article->id }}">
							<span class="mr-1 dislikes-count{{ $article->id }}">{{ $article->dislikes_count }}</span>
							<span class="text-danger">-</span>
						</div>
					</div>
					<small class="text-dark">{{ $article->comments_count }} {{ __('comments') }}</small>
				</div>
			</div>
			<div class="modal fade" id="delete{{ $article->id }}">
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
			@endforeach
		</div>
		<div class="tab-pane fade {{ \Request::get('tab') == 'people' ? 'active show' : '' }}" id="people">
			<h1 class="mb-4">{{ __('People') }}</h1>
			@foreach($users as $user)
			<div class="card shadow">
				<div class="card-body">
					<div class="d-md-flex justify-content-between align-items-center">
						<a href="{{ route('profile.view', [app()->getLocale(), $user->slug]) }}" class="d-flex align-items-center mb-3 mb-md-0 text-dark">
							<img srcset="{{ $user->avatar }}, {{ config('app.avatar') }}" alt="{{ $user->name }}" height="50" width="50" class="img-cover rounded-circle">
							<h3 class="ml-3">{{ $user->name }}</h3>
						</a>
						<div>
							@auth
							<button class="btn btn-success subscribe-btn unsubscribed" data-href="{{ route('subscribe', $user->id) }}" {{ $user->subscription ? 'hidden' : '' }} data-subscribed=".subscribed" data-unsubscribed=".unsubscribed">{{ __('Subscribe') }}</button>
							<button class="btn btn-secondary subscribe-btn subscribed" data-href="{{ route('unsubscribe', $user->id) }}" {{ $user->subscription ? '' : 'hidden' }} data-subscribed=".subscribed" data-unsubscribed=".unsubscribed">{{ __('Unsubscribe') }}</button>
							@endauth
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="/js/likes.js"></script>
<script src="/js/subscription.js"></script>
<script>
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $('#search-tab-input').val($(e.target).attr("href").replace('#', ''))
    history.pushState(null, null, location.pathname + '?' + $('#search-form').serialize())
  });
</script>
@endsection
