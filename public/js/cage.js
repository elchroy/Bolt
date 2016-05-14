$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
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





var toggleDiv = function (buttonID, divID, commonClass)
{
  // console.log(buttonID);
    $('#' + buttonID).click(function () {
        $('.' + commonClass).not('[id='+divID+']').addClass(['fadeOutUp']).hide();
        // $('.' + commonClass).not('[id='+divID+']').fadeOut(600);
        // $('#'+divID).toggle('fade');
        $('#'+divID).toggle();
        // $('#'+divID).fadeToggle(600);
    });
}



