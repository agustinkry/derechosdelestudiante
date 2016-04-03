$(document).ready(function () {

    // make sure div stays full width/height on resize
    $(window).resize(function () {
        var winWidth = $(window).width() - 40;
        var winHeight = $(window).height() - 40;

        $('body').css({
            'width': winWidth,
            'height': winHeight
        });
    });

    // set initial div height / width
    $(window).resize();
});

$("#search").click(function(){
      $("nav li input").toggleClass("show");
  });


    // Pretty simple huh?
    var scene = document.getElementById('elements');
    var parallax = new Parallax(scene);
