$(document).ready(function(){
    $(".try").each(function(){
      $(this).mouseenter(function(){
        $(this).find('.overlay').css('opacity','1');
      });

      $(this).mouseleave(function(){
        $(this).find('.overlay').css('opacity','0');
      });
    });

    $('.product').hover(function() {
    	$(this).find('img').addClass('transition');
    }, function() {
        $(this).find('img').removeClass('transition');
    });

  });