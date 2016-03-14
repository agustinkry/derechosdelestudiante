$(document).ready(function(){
   $(window).on("resize", function(){
     $(".content").css("min-height", $(window).height()+"px");
   });
   $(window).trigger("resize");
});