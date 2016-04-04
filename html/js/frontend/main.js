var $rightOptions;

$(document).ready(function () {

    // make sure div stays full width/height on resize
    $(window).resize(function () {
        var winWidth = $(window).width() - 40;
        var winHeight = $(window).height() - 40;

        if (winWidth > 680) {


            $('body').css({
                'width': winWidth,
                'height': winHeight
            });
            $('html').removeClass("mobile")

        } else {

            $('body').css({
                'width': "auto",
                'height': "auto"
            });
            $('html').addClass("mobile")

        }

    });

    // set initial div height / width
    $(window).resize();


    $rightOptions = $("#right select option");

    $("#category").change(function () {
        var $filteredRights = [];
        var categoryId = $("#category option:selected").val();
        if (categoryId != "-1") {
            $rightOptions.each(function (key, value) {
                if (key == 0) {
                    $filteredRights.push($rightOptions[key]);
                } else {
                    var dataCategory = $(value).attr("data-category");
                    if (typeof dataCategory != "undefined") {
                        $.each(dataCategory.split(","), function (k, v) {
                            if (v == categoryId) {
                                $filteredRights.push($rightOptions[key]);
                            }
                        });
                    }
                }
            });
        }else{
            $filteredRights = $rightOptions;
        }
        
        $("#right select").html($filteredRights);
    });
});

$("#search").click(function () {
    $("nav li input").toggleClass("show");
});


// Pretty simple huh?
var scene = document.getElementById('elements');
var parallax = new Parallax(scene);
