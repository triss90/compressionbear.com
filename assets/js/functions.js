function result() {
  var info = $('.result');
  info.show();
}

function compressor() {

  var $progress = $(".progress"),
      $bar = $(".progress__bar"),
      $text = $(".progress__text"),
      percent = 0,
      update,
      speed = 1,
      orange = 30,
      yellow = 55,
      green = 85,
      timer,
      checkExist;

  update = function() {
    timer = setTimeout( function() {
      percent += Math.random() * 1.8;
      percent = parseFloat( percent.toFixed(1) );
      $text.find("strong").text( percent + "%" );
      if( percent >= 100 ) {
        percent = 100;
        $progress.addClass("progress--complete");
        $bar.addClass("progress__bar--blue");
        $text.find("strong").text( "Complete" );
      } else {
        if( percent >= green ) {
          $bar.addClass("progress__bar--green");
        }
        else if( percent >= yellow ) {
          $bar.addClass("progress__bar--yellow");
        }
        else if( percent >= orange ) {
          $bar.addClass("progress__bar--orange");
        }
        speed = Math.floor( Math.random() * 50 );
        update();
      }
      $bar.css({ width: percent + "%" });
    }, speed);
  };

  checkExist = setInterval(function() {
     if ($('.dz-started').length) {
        $progress.addClass("progress--active");
        update();
        setTimeout( function(){
          $('.progress').hide();
          result();
        }, 4200 );
        clearInterval(checkExist);
     }
  }, 100);

  checkExist();

}



$(function() {
  compressor();
});
