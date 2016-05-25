$(document).ready( function () {

postComment = $('#post-comment');

postComment.click( function (e) {
	
	e.preventDefault();

	inputComment = $('#new-comment');

	var newComment = inputComment.val();
	var commenter = inputComment.attr('commenter');
	commentToken = $('#comment-token').val();
	action = $('#new-comment-form').attr('action');
	data = {_token: commentToken, comment: newComment}

	$.post(action, data, function (d) {
		res = JSON.parse(d);
		id = res.id;
		edittoken = res.edittoken;
		deltoken = res.deltoken;
		time = res.time;
		edited = res.edited;
		
		comment = prepareUpdateHTML(newComment, id, commenter, edittoken, deltoken, time, edited);

		$('#video-comments').find('div.single-comment:last-child').remove();
		$('#video-comments').prepend(comment);

		toggleDiv("open-edit-for-" + id, "edit-comment-" + id , "comment-forms", 600);
		toggleDiv("open-delete-for-" + id, "delete-comment-" + id , "comment-forms", 600);
		watchforedit('submit-comment-edit-buttons');
		watchfordelete('submit-comment-delete-buttons');
	});

});

var prepareUpdateHTML = function (newComment, id, commenter, edittoken, deltoken, time, edited) {
	delForm = '<div class="col-md-12 comment-forms alert alert-warning fadeIn animated" hidden id="delete-comment-' + id + '"><form class="bolt-form" action="/comments/' + id + '" id="comment-delete-form-' + id + '" method="POST"><input type="hidden" name="_token" id="delete-token" value="' + deltoken + '"><input type="hidden" name="_method" id="delete-method" value="delete"><div> Are you sure you want to delete this comment?</div><button class="button-full submit-comment-delete-buttons" comment="' + id + '" id="submit-comment-delete-' + id + '" type="submit">Delete</button></form></div>';
	editForm = '<div class="col-md-12 comment-forms fadeIn animated" hidden id="edit-comment-' + id + '"><form action="/comments/' + id + '" class="bolt-form" id="comment-edit-form-' + id + '" method="POST"><input type="hidden" name="_token" id="edit-token" value="' + edittoken + '"><input type="hidden" name="_method" id="edit-method" value="patch"><textarea name="comment" id="comment" placeholder="Edit a comment." maxlength="255" required>' + newComment + '</textarea><button class="button-full submit-comment-edit-buttons" comment="' + id + '" id="submit-comment-edit-' + id + '" type="submit">Update</button></form></div>';
	comment = '<div class="maincontainer one-comment" id="single-comment-' + id + '"><div class="leftcolumn commenter-info"><img src="' + commenter + '" class="commenter-avatar img-responsive"></div><div class="contentwrapper comment-body"><p class="comment-text" id="comment-text-' + id + '">' + newComment + '</p><p class="comment-info"><span class="comment-time" id="comment-time-' + id + '"> just now.</span><span class="comment-edited" id="edited-' + id +'"></span><a href="#" title="Edit" class="pull-right comment-form-openers" comment="' + id + '" for="edit-comment-' + id + '" id="open-edit-for-' + id +'"> <i class="fa fa-edit"></i></a><a href="#" title="Delete" class="pull-right comment-form-openers" comment="' + id + '" for="delete-comment-' + id + '" id="open-delete-for-' + id + '"> <i class="fa fa-trash"></i></a></p></div></div>';
	return comment + editForm + delForm;
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
});

watchforedit('submit-comment-edit-buttons');

watchfordelete('submit-comment-delete-buttons');






});

var watchforedit = function (editbutton) {
	$('.' + editbutton).click( function (e) {

		e.preventDefault();

		var commentID = $(this).attr('comment');

		var comment = $('#submit-comment-edit-' + commentID).siblings('#comment').val();
		action = $('#comment-edit-form-' + commentID).attr('action');
		token = $('#submit-comment-edit-' + commentID).siblings('#edit-token').val();
		method = $('#submit-comment-edit-' + commentID).siblings('#edit-method').val();

		data = {_token: token, comment: comment, _method: method}

		$.post(action, data, function (d) {
			d = JSON.parse(d);
			console.log(d);
			time = d.time;
			edited = d.edited;
			$('#open-edit-for-' + commentID).trigger('click');
			$('.comment-text#comment-text-' + commentID).html(comment);
			$('.comment-time#comment-time-' + commentID).html(time);
			$('.comment-edited#edited-' + commentID).html(edited);
			// $('#edited-' + commentID).html('| (edited)');
		});
	});
}


var watchfordelete = function (deletebutton) {
	$('.' + deletebutton).click( function (e) {

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
}