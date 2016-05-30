var showError = function () {
	$('#url-check').removeClass('alert-success').addClass('alert-danger').html('<i class="fa fa-times fa-lg"></i>Video not found on YouTube.');
}

var showSuccess = function () {
	$('#url-check').removeClass('alert-danger').addClass('alert-success').html('<i class="fa fa-check fa-lg"></i>');
}

$(document).ready( function () {

    $('.video-fields#url').on('change', function () {
    	vurl = $(this).val();
    	var url = '/check?url=' + vurl;
    	
    	$.get(url, function (d) {

    		if (d.trim() == "found") {
				showSuccess();
			} else {
				showError();
			}
    	});
    });
});