$('.message a').click(function(e){
	e.preventDefault();
	except = $(this).attr('for');
	animdata = {height: "toggle", opacity: "toggle"};
    $('.bolt-forms').not('#' + except).animate( animdata, "slow");
    $('#' + except).animate( animdata, 1000); 
});