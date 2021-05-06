@extends('layouts.app')

@section('content')
<div class="bg-light py-5 shadow	">
	<div class="container">
		<div class="d-flex align-items-start justify-content-between">
			<h1 class="mb-4">{{ $article->title }}</h1>
			@if($article->user->id == \Auth::id())
			<div class="dropdown">
				<button class="btn" id="dropdownBlog" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="/images/icons/more.svg" alt="More"/>
				</button>
				<div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownBlog">
					<a class="dropdown-item" href="{{ route('blog.edit', [app()->getLocale(), $article->slug]) }}">{{ __('Edit') }}</a>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete">{{ __('Delete') }}</a>
				</div>
			</div>
			@endif 
		</div>
		<div>
			<div class="mb-3 d-flex align-items-center">
				<a href="{{ route('profile.view', [app()->getLocale(), $article->user->slug]) }}" class="text-dark mr-3 d-flex align-items-center">
					<img srcset="{{ $article->user->avatar }}, {{ config('app.avatar') }}" alt="{{ $article->user->name }}" class="img-cover rounded-circle mr-2" width="20" height="20">
					{{ $article->user->name }}
				</a>
				<small class="text-dark">{{ $article->date }}</small>
			</div>
			<div class="d-flex">
				<div class="c-pointer d-flex align-items-center mr-4 like-btn" data-href="{{ route('blog.like', $article->id) }}" data-likes=".likes-count" data-dislikes=".dislikes-count">
					<span class="mr-1 likes-count">{{ $article->likes_count }}</span>
					<span class="text-success">+</span>
				</div>
				<div class="c-pointer d-flex align-items-center like-btn" data-href="{{ route('blog.dislike', $article->id) }}" data-likes=".likes-count" data-dislikes=".dislikes-count">
					<span class="mr-1 dislikes-count">{{ $article->dislikes_count }}</span>
					<span class="text-danger">-</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container py-5">
	<p class="mb-4">{!! nl2br($article->subtitle) !!}</p>
	<div class="from-cke mb-5">{!! $article->content !!}</div>
	<div class="mb-4">
		@foreach($article->categories as $category)
		<a href="{{ route('blog', [app()->getLocale(), 'cat' => $category->slug]) }}" class="mr-3">
			#{{ $category->name }}
		</a>
		@endforeach
	</div>
	<div id="app" class="fade">
		@verbatim
		<h6 class="mb-4">{{ count }} <?=__('comments')?></h6>
		<note-comment :comment="comment" v-for="comment in comments" :key="comment.id" :locale="'<?=app()->getLocale()?>'" :defaultavatar="'<?=config('app.avatar')?>'"></note-comment>
		<form class="mb-4 form-comment" method="POST" action="" @submit.prevent="send">
			<?php if(\Auth::check()) { ?>
			<input type="hidden" name="image" id="img-input" v-model="comment.image">
			<input type="hidden" name="reply_to" id="reply-input" v-model="comment.reply_to">
			<img :src="comment.image" alt="image" v-if="comment.image" id="preview" width="200" class="mb-3">
			<div class="form-group">
				<textarea name="text" class="form-control" placeholder="<?=__('Leave a comment')?>..." v-model="comment.text" required></textarea>
			</div>
			<div class="d-flex justify-content-between align-items-center">
				<div class="">
					<p v-if="reply" class="mb-0">
						<?=__('Reply to')?> {{ reply.user.name }} <a href="#" class="color-gray ml-3" @click.prevent="reply = null"><?=__('Cancel')?></a>
					</p>
				</div>
				<div class="d-flex align-items-center">
					<label class="mr-3 c-pointer mb-0">
						<input type="file" id="file-input" name="file" class="d-none" @change="preview($event)">
						<?=__('Attach image')?>
					</label>
					<button class="btn btn-primary"><?=__('Send')?></button>
				</div>
			</div>
			<?php } ?>
		</form>
		@endverbatim
	</div>
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
@auth
<script src="/js/likes.js"></script>
@endauth
<script type="module">
	
	var app = new Vue({
		el: '#app',
		data: {
			comments: [],
			comment: {},
			reply: null,
			count: 0
		},
		watch: {
			reply: function() {
				window.scrollTo(0, window.scrollY + this.$el.querySelector('.form-comment').getBoundingClientRect().y - 150)
			}
		},
		methods: {
			preview: function(event) {
				this.comment.image = ''
				if(event.target.files && event.target.files[0]) {
					var reader = new FileReader()
					reader.onload = e => {
						this.comment.image = e.target.result
						this.$forceUpdate()
					}
					reader.readAsDataURL(event.target.files[0])
					this.$forceUpdate()
				}
			},
			send: function() {
				if(this.reply) {
					this.comment.reply_to = this.reply.id
				}
				fetch('<?=route('blog.comment', $article->id)?>' + '?api_token=' + window.apiToken, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify(this.comment)
				})
				.then(response => response.json())
				.then(json => {
					this.loadComments()
					this.comment = {}
					this.reply = null
				})
			},
			loadComments: function(sort = null) {
				this.$el.classList.add('fade')
				fetch('<?=route('blog.comments', $article->id)?>')
				.then(response => response.json())
				.then(json => {
					this.comments = json.comments
					this.count = json.count
					document.querySelectorAll('.comments-count').forEach(el => el.innerText = this.comments.length)
					this.$el.classList.remove('fade')
				})
			}
		},
		mounted() {
			this.loadComments()
		}
	})
</script>
@endsection