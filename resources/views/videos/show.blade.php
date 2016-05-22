@extends('layouts.app')

@section('scripts')
	<script type="text/javascript">
		$(document).ready( function () {
			// keepSideBar("video-left");

			postComment = $('#post-comment');

			postComment.click( function (e) {
				
				e.preventDefault();

				var newComment = $('#new-comment').val();
				commentToken = $('#comment-token').val();
				action = $('#new-comment-form').attr('action');
				data = {_token: commentToken, comment: newComment}

				$.post(action, data, function (d) {
					comment = prepareCommentHTML(newComment);

					$('#video-comments').find('div.single-comment:last-child').remove();
					$('#video-comments').prepend(comment);
				});

			});

			var prepareCommentHTML = function (newComment) {
				comment = "<div class='col-md-12 single-comment'><div class='row single-comment-row'><div class='col-md-2 commenter-avatar'><img class='img-responsive' src='{ { Auth::user()->getAvatar() } }'></div><div class='col-md-10 comment-body'><p class='comment-text'>" + newComment + "</p><p class='comment-info'></p></div></div></div>";
				return comment;
			}

			fav = $('#favForm');
			


			fav.click( function (e) {
				e.preventDefault();

				action = $(this).attr('action');
				token = fav.children('#_token').val();
				data = {_token: token};

				$.post(action, data, function (d) {

					button = fav.children('.fav-button');
					id = button.attr('id');
					'<i class="fa fa-lg fa-heart"></i>'
			

					if (id == 'button-favorite') {
						replaceClass = 'button-unfavorite';
						replaceHTML = '<i class="fa fa-lg fa-heart"></i> Unlike';
					} else if (id == 'button-unfavorite') {
						replaceClass = 'button-favorite';
						replaceHTML = '<i class="fa fa-lg fa-heart-o"></i> Like';
					}

					
					actionArray = action.split('/');
					currentAction = actionArray[3];
					currentVideo = actionArray[2];
					var reverseAction;
					
					if (currentAction == 'favorite') {
						reverseAction = 'unfavorite';
					} else {
						reverseAction = 'favorite';
					}


					button.attr('id', function () {
						return 'button-' + reverseAction;
					});


					button.removeClass(id).addClass(replaceClass).html(replaceHTML);
					
					fav.attr('action', function () {
						return '/videos/' + currentVideo + '/' + reverseAction;
					});
				});

			});

			$('.comment-form-openers').click( function () {

				id = $(this).attr('id');
				commentID = $(this).attr('comment');
				divID = $(this).attr('for');
				performToggle(id, divID, "comment-forms");
				// $('.current-comment#current-comment-' + commentID).addClass('fadeOutRight animated').hide();
				// $('.current-comment#current-comment-' + commentID).toggle();
			});


			$('.submit-comment-edit-buttons').click( function (e) {

				e.preventDefault();

				var commentID = $(this).attr('comment');
				var comment = $('#submit-comment-edit-' + commentID).siblings('#comment').val();
				action = $('#comment-edit-form-' + commentID).attr('action');
				token = $('#submit-comment-edit-' + commentID).siblings('#edit-token').val();
				method = $('#submit-comment-edit-' + commentID).siblings('#edit-method').val();
				
				data = {_token: token, comment: comment, _method: method}

				$.post(action, data, function (d) {
					$('#open-edit-for-' + commentID).trigger('click');
					$('.comment-text#comment-text-' + commentID).html(comment);
					$('#edited-' + commentID).html('| (edited)');
				});
			});


			$('.submit-comment-delete-buttons').click( function (e) {

				e.preventDefault();

				var commentID = $(this).attr('comment');
				action = $('#comment-delete-form-' + commentID).attr('action');
				token = $('#submit-comment-delete-' + commentID).siblings('#delete-token').val();
				method = $('#submit-comment-delete-' + commentID).siblings('#delete-method').val();
				
				data = {_token: token, _method: method}
				
				$.post(action, data, function (d) {
					$('#open-delete-for-' + commentID).trigger('click');
					$('#single-comment-' + commentID).remove();
				});
			});

		});
	</script>
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
			    	<form action="/videos/{{ $video->id }}/comments/add" class="bolt-form" id="new-comment-form" method="POST">
						<input type="hidden" id="comment-token" name="_token" value="{{ csrf_token() }}">
						<textarea name="comment" id="new-comment" placeholder="Post a comment." maxlength="255" required>{{ old('comment') }}</textarea>
					      <span class="help-block">
                                <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                    	<button class="bolt-button button-full" id="post-comment" type="submit">POST</button>
					</form>

		    	<div class="row bolt-div" id="video-comments">

	    			@foreach($comments as $comment)
	    				<div class="col-md-12 col-sm-6 single-comment" id="single-comment-{{$comment->id}}">
	    					<div class="row single-comment-row">
	    						<div class="col-md-2 col-sm-3 col-xs-3 commenter-avatar">
	    							<img class="img-responsive" src="{{ $comment->user->getAvatar() }}">
    								@if(Auth::user())
    									@if(Auth::user()->owns($comment))
		    								<a href="#" class="comment-form-openers" comment="{{$comment->id}}" for="edit-comment-{{ $comment->id }}" id="open-edit-for-{{$comment->id}}"> <i class="fa fa-edit"></i> Edit</a>
		    								<a href="#" class="comment-form-openers" comment="{{$comment->id}}" for="delete-comment-{{ $comment->id }}" id="open-delete-for-{{$comment->id}}"> <i class="fa fa-trash"></i> Delete</a>
		    							@endif
    								@endif
	    						</div>
	    						<div class="col-md-10 col-sm-9 comment-body">
	    							<div class="row">
	    								<div class="col-md-12 current-comment" id="current-comment-{{$comment->id}}">
	    									<p class="comment-text" id="comment-text-{{$comment->id}}" >{{ $comment->comment }}</p>
		    								<p class="comment-info" id="comment-info-{{$comment->id}}" >{{ $comment->commentedAt() }} <span id="edited-{{$comment->id}}">{{ $comment->is_edited() }}</span></p>
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
														<div> Are you sure?</div>
								                    	<button class="button-full submit-comment-delete-buttons" comment="{{$comment->id}}" id="submit-comment-delete-{{$comment->id}}" type="submit">Delete</button>
													</form>
							    				</div>
		    								@endif
	    								@endif
	    							</div>
	    						</div>
	    					</div>
	    				</div>
	    				
	    			@endforeach
		    	</div>
	    	</div>
	    </div>
	<!-- </div> -->
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
	}

	.single-comment {
		border-bottom: rgba(204, 204, 204, 0.54) solid 2px;
    	padding: 3px;
	}

	.commenter-avatar {
		padding: 0;

	}

	.single-comment-row div {
		padding: 0 17px;
	}

	.comment-info {
		font-style: italic;
    	color: #8F0A0A;
    	font-size: 85%;
	}

	#like-button {
		padding: 0px;
	}

	.comment-text {
		word-wrap: break-word;
	    text-align: justify;
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