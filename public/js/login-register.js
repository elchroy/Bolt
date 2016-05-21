$('.message a').click(function(e){
	e.preventDefault();
	except = $(this).attr('for');
    $('.bolt-forms').not('#' + except).animate({height: "toggle", opacity: "toggle"}, "slow");
    $('#' + except).animate({ height: "toggle", opacity: "toggle"}, 1000); 
});