@extends('layouts.app')
@section('content')
<div class="bg-light py-5 shadow">
	<div class="container">
		<div class="d-flex align-items-start justify-content-between">
			<div>
				<h1 class="mb-4">{{ $note->title }}</h1>
				<h5 class="mb-3">
					<a class="text-dark" href="{{ route('projects.view', [app()->getLocale(), $note->commentable->slug]) }}">{{ __('Project') }}: {{ $note->commentable->title }}</a>
				</h5>
			</div>
			@if($note->user->id == \Auth::id())
			<div class="dropdown">
				<button class="btn" id="dropdownBlog" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="/images/icons/more.svg" alt="More"/>
				</button>
				<div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownBlog">
					<a class="dropdown-item" href="{{ route('notes.edit', [app()->getLocale(), $note->slug]) }}">{{ __('Edit') }}</a>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete">{{ __('Delete') }}</a>
				</div>
			</div>
			@endif 
		</div>
		<div class="d-flex">
			<div class="c-pointer d-flex align-items-center mr-4 like-btn" data-href="{{ route('comment.like', $note->id) }}" data-likes=".likes-count" data-dislikes=".dislikes-count">
				<span class="mr-1 likes-count">{{ $note->likes_count }}</span>
				<span class="text-success">+</span>
			</div>
			<div class="c-pointer d-flex align-items-center like-btn" data-href="{{ route('comment.dislike', $note->id) }}" data-likes=".likes-count" data-dislikes=".dislikes-count">
				<span class="mr-1 dislikes-count">{{ $note->dislikes_count }}</span>
				<span class="text-danger">-</span>
			</div>
		</div>
	</div>
</div>
<div class="container py-5">
	<div class="from-cke mb-5">{!! $note->text !!}</div>
	<hr>
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
				fetch('<?=route('note.comment', $note->id)?>' + '?api_token=' + window.apiToken, {
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
				fetch('<?=route('note.comments', $note->id)?>')
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