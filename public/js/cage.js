$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {

    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      // $('#processor').show();
        
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - 70
        }, 1500);

        return false;
      }
      // $('#processor').hide();
        
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





var toggleDiv = function (buttonID, divID, commonClass, time = null)
{
  // console.log(buttonID);
    $('#' + buttonID).click(function () {
        performToggle(buttonID, divID, commonClass, time);
    });
}

var performToggle = function (buttonID, divID, commonClass, time = null) {
  $('.' + commonClass).not('[id='+divID+']').addClass(['fadeOutUp']).hide(time);
  // $('.' + commonClass).not('[id='+divID+']').fadeOut(600);
  // $('#'+divID).toggle('fade');
  $('#'+divID).toggle(time);
  // $('#'+divID).fadeToggle(600);
}



