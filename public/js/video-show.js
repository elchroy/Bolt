$(document).ready( function () {

postComment = $('#post-comment');

postComment.click( function (e) {
	
	e.preventDefault();

	var newComment = $('#new-comment').val();
	commentToken = $('#comment-token').val();
	action = $('#new-comment-form').attr('action');
	data = {_token: commentToken, comment: newComment}

	$.post(action, data, function (d) {
		res = JSON.parse(d);
		comment = prepareCommentHTML(newComment, res.id);

		$('#video-comments').find('div.single-comment:last-child').remove();
		$('#video-comments').prepend(comment);
	});

});


'';

var prepareCommentHTML = function (newComment, id) {
	comment = '<div class="maincontainer one-comment"><div class="leftcolumn commenter-info"><img src="{{ Auth::user()->getAvatar() }}" class="commenter-avatar img-responsive"></div><div class="contentwrapper comment-body"><p class="comment-text">' + newComment + '</p><p class="comment-info"><span class="comment-time">just now</span><a href="" title="Edit" class="pull-right comment-form-openers" comment="' + id + '" for="edit-comment-' + id + '" id="open-edit-for-' + id +'"> <i class="fa fa-edit"></i></a><a href="#" title="Delete" class="pull-right comment-form-openers" comment="' + id + '" for="delete-comment-' + id + '" id="open-delete-for-' + id + '"> <i class="fa fa-trash"></i></a></p></div></div>';
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

$('.comment-form-openers').click( function (e) {

	e.preventDefault();

	id = $(this).attr('id');
	commentID = $(this).attr('comment');
	divID = $(this).attr('for');
	performToggle(id, divID, "comment-forms", 600);
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