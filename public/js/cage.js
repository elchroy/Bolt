$(function() {
  $('a[href*="#"]:not([href="#"])').not('#back-top').click(function() {

    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);

      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - 70
        }, 1500);

        return false;
      }
        
    }
  });
});

$( function () {
  $('a').click( function () {
    
  });
});

var keepSideBar = function (sidebarId)
{
  var $sidebar   = $("#" + sidebarId),
    $window    = $(window),
    offset     = $sidebar.offset(),
    topPadding = 70;


    $window.scroll(function() {
      if ($window.scrollTop() > offset.top - 70) {
          $sidebar.stop().animate({
              marginTop: $window.scrollTop() - offset.top + topPadding
          });
      } else {
          $sidebar.stop().animate({
              marginTop: 0
          });
      }
    });
}

$(window).scroll(function () {
  if ($(this).scrollTop() > 300) {
    $('#back-top').fadeIn();
  } else {
    $('#back-top').fadeOut();
  }
});
if ($(this).scrollTop() > 300) {
  $('#back-top').fadeIn();
} else {
  $('#back-top').fadeOut();
}


$('#back-top').click(function() {
  $(this).hide(600);
  scrollToElement("html", 1500);
  $(this).show(600);
});


var scrollToElement = function(el, ms){
  var speed = (ms) ? ms : 1000;
  $('html,body').animate({
      scrollTop: $(el).offset().top - 70
  }, speed);
}





var toggleDiv = function (buttonID, divID, commonClass, time = null)
{
    $('#' + buttonID).click(function (e) {
        e.preventDefault();

        performToggle(buttonID, divID, commonClass, time);
    });
}

var closeDiv = function (divClass)
{
  $('.close-form').click( function (e) {
      e.preventDefault();
      id = $(this).attr('id');
      $('.' + divClass + '#' + id).hide(600);
  });
}

var performToggle = function (buttonID, divID, commonClass, time = null) {
  $('.' + commonClass).not('[id='+divID+']').addClass(['fadeOutUp']).fadeOut();
  // $('.' + commonClass).not('[id='+divID+']').fadeOut(600);
  // $('#'+divID).toggle('fade');
  $('#'+divID).fadeToggle(time);
}

var toggPerform = function (buttonID, divID, commonClass, time = null) {

  $('#' + buttonID).click(function () {
    $('.' + commonClass + '#' + divID).toggle(time);
    // $('#'+divID).fadeToggle(600);
  });
}



