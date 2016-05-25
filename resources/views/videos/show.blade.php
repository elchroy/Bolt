@extends('layouts.app')

@section('scripts')
	@if(Auth::user())
		<script type="text/javascript" src="{{ asset('js/video-show.js') }}"></script>
	@endif
@endsection

@section('content')

	    <div class="row">
	    	<div class="col-md-9" id="video-left">
	    		<div id="video-screen">
	    			<iframe id="video-frame" src="{{ $video->srcFrame() }}?autoplay=0" frameborder="0" allowfullscreen ></iframe>
	    		</div>

	    		<div class="row">
		    		<div class="col-md-10 col-sm-10 video-group-title">
				    	<h2>{{ $video->title }}</h2>
				    </div>
		    		<div class="col-md-2 col-sm-2" id="like-button">
				    	@if(Auth::user())
							<div>
							    @if( Auth::user()->favors($video) )
							        @include('partials.fav', [
							        	'action' => 'unfavorite',
							        	'model' => 'videos',
							        	'id' => $video->id,
							        	'button' => 'Unlike',
							        ])
							    @else
							        @include('partials.fav', [
							        	'action' => 'favorite',
								        'model' => 'videos',
								        'id' => $video->id,
								        'button' => 'Like',
							       	])
							    @endif
							</div>
						@else
							<a href="{{ url('/login') }}"><button class="bolt-button button-half">Like this video</button></a>
						@endif
				    </div>
	    		</div>
	    			
	    	</div>
	    	<div class="col-md-3 video-right">
	    		@if(Auth::user())
			    	<form action="/videos/{{ $video->id }}/comments/add" class="bolt-form" id="new-comment-form" method="POST">
						<input type="hidden" id="comment-token" name="_token" value="{{ csrf_token() }}">
						<textarea name="comment" id="new-comment" commenter="{{ Auth::user()->getAvatar() }}" placeholder="Post a comment." maxlength="255" required>{{ old('comment') }}</textarea>
					      <span class="help-block">
                                <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                    	<button class="bolt-button button-full" id="post-comment" type="submit">POST</button>
					</form>
				@else
					<a href="{{ url('/login') }}"><button class="bolt-button bolt-calling">Login to comment</button></a>
	    		@endif

		    	<div class="bolt-div" id="video-comments">
		    		@foreach($comments as $comment)

		    		<div class="maincontainer one-comment" id="single-comment-{{ $comment->id }}">
					    <div class="leftcolumn commenter-info">
					    	<img src="{{ $comment->user->getAvatar() }}" class="commenter-avatar img-responsive">
					    </div>
					 
					    <div class="contentwrapper comment-body">
					    	<p class="comment-text" id="comment-text-{{$comment->id}}">{{ $comment->comment }}</p>
		    				<p class="comment-info">
		    					<span class="comment-time" id="comment-time-{{ $comment->id }}">{{ $comment->commentedAt() }}</span>
		    					<span class="comment-edited" id="edited-{{$comment->id}}">{{ $comment->is_edited() }}</span>
								@if(Auth::user())
									@if(Auth::user()->owns($comment))
										<a href="#" title="Edit" class="pull-right comment-form-openers" comment="{{$comment->id}}" for="edit-comment-{{ $comment->id }}" id="open-edit-for-{{$comment->id}}"> <i class="fa fa-edit"></i></a>
		    							<a href="#" title="Delete" class="pull-right comment-form-openers" comment="{{$comment->id}}" for="delete-comment-{{ $comment->id }}" id="open-delete-for-{{$comment->id}}"> <i class="fa fa-trash"></i></a>
									@endif
								@endif
		    				</p>
					    </div>
					</div>
						@if(Auth::user())
							@if(Auth::user()->owns($comment))

								<div class="col-md-12 comment-forms fadeIn animated" hidden id="edit-comment-{{ $comment->id }}">
			    					<form action="/comments/{{$comment->id}}" class="bolt-form" id="comment-edit-form-{{$comment->id}}" method="POST">
										<input type="hidden" name="_token" id="edit-token" value="{{ csrf_token() }}">
										<input type="hidden" name="_method" id="edit-method" value="patch">
										<textarea name="comment" id="comment" placeholder="Edit a comment." maxlength="255" required>{{ $comment->comment }}</textarea>
									      <span class="help-block">
				                                <strong>{{ $errors->first('comment') }}</strong>
				                            </span>
				                    	<button class="button-full submit-comment-edit-buttons" comment="{{$comment->id}}" id="submit-comment-edit-{{$comment->id}}" type="submit">Update</button>
									</form>
			    				</div>

			    				
								<div class="col-md-12 comment-forms alert alert-warning fadeIn animated" hidden id="delete-comment-{{ $comment->id }}">
			    					<form class="bolt-form" action="/comments/{{$comment->id}}" id="comment-delete-form-{{$comment->id}}" method="POST">
										<input type="hidden" name="_token" id="delete-token" value="{{ csrf_token() }}">
										<input type="hidden" name="_method" id="delete-method" value="delete">
										<div> Are you sure you want to delete this comment?</div>
				                    	<button class="button-full submit-comment-delete-buttons" comment="{{$comment->id}}" id="submit-comment-delete-{{$comment->id}}" type="submit">Delete</button>
									</form>
			    				</div>

							@endif
						@endif
		    		@endforeach
		    	</div>
	    	</div>
	    </div>
@endsection

<style type="text/css">

	#video-screen {
		position: relative;
		height: 0;
		/*padding-top: 25px;*/
		padding-bottom: 56.25%; /* 16:9 */
	}

	#video-screen iframe {
		position: absolute;
		/*top: 0;*/
		left: 0;
		right: 0;
		width: 100%;
		height: 100%;
	}

	.video-right {
		padding: 5px;
	}

	.video-right form {
		margin: 0px;
		padding: 5px;
	}

	.bolt-div,
	.bolt-form {
		box-shadow: none !important;
	}

	.video-right div#video-comments {
		padding: 0px;
		max-width: 100%;
		/*max-height: 60vh;*/
		/*overflow: scroll;*/
	}

	.video-right form textarea {
		margin: 0px;
	}

	.maincontainer.one-comment {
	    width: 100%;
	    display:inline-block;
	    padding: 3px;
		min-height: 50px;
		border-bottom: #f2f2f2 solid 2px;
	}
	.leftcolumn.commenter-info {
	    float:left;
	    width: 100%;
	    height: auto;
		padding: 0;
		width: 15%;
	}
	.contentwrapper {
	    float:right;
	    width:80%;
	    min-height: 50px;
	    padding: 3px 10px !important;
	    word-wrap: break-word;
	    text-align: justify;
	}

	.single-comment {
		border-bottom: rgba(204, 204, 204, 0.54) solid 2px;
    	padding: 3px;
	}

	.comment-info {
		font-weight: bold;
		font-size: smaller;
		font-style: italic;
		padding: 3px;
		background: #f2f2f2;
		color: #C52020;
	}

	.commenter-avatar {
		width: 100%;
		height: auto;
	}

	.comment-info a {
		padding: 3px;
	}

	.single-comment-row div {
		padding: 0 17px;
	}

	.comment-body {
		padding: 0px;
		display: block;
	}

	#like-button {
		padding: 0px;
	}

	.comment-text {
		
	}

	iframe {
		position: absolute;
	}
</style>


<!-- <form action="/videos/{{ $video->id }}/comments/add" method="POST">
	<input type="_hidden" name="_token" value="{{ csrf_token() }}">
	<input type="text" name="comment" value="{{ old('comment') }}" maxlength="255" required>
	<button type="submit">POST</button>
</form>

@if(Auth::user())
<div>
    @if( Auth::user()->favors($video) )
        @include('partials.fav', ['action' => 'unfavorite', 'model' => 'videos', 'id' => $video->id, 'button' => 'Unfavorite'])
    @else
        @include('partials.fav', ['action' => 'favorite', 'model' => 'videos', 'id' => $video->id, 'button' => 'Favorite'])
    @endif
</div>
@endif

@foreach($comments as $comment)
{{ $comment->title }}
@endforeach -->