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
            // Pretty simple huh?
            if ($('#elements').length > 0) {
                var scene = document.getElementById('elements');
                var parallax = new Parallax(scene);
            }

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
        } else {
            $filteredRights = $rightOptions;
        }

        $("#right select").html($filteredRights);
    });

    $("#searchForm").submit(function (e) {
        var searchQuery = $(this).attr("action") + $("#searchText").val();
        window.location.href = searchQuery;
        return false;
    });



    $("#btn_consulta, #btn_consult").click(function () {
        selectDefault();
        $(".md-modal").addClass("md-show");
        $("#container_form input, #container_form textarea").val("")
    });
    $("#btn-close").click(function () {
        $(".md-modal").removeClass("md-show");
        $("#sent").hide();
        $("#container_form").show();
    });



    //contact form
    var sendingInfo = false;
    var hideMessageTimer;
    $('#sendMessage').click(function (e) {
        e.preventDefault();

        if (validateForm() && !sendingInfo) {
            sendingInfo = true;
            $(".loading").fadeIn();
            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/frontend/ajax/home/sendMessage.php",
                data: $("#contact_form").serialize(),
                dataType: "json"
            }).done(function (data) {

                if (data.result === true) {
                    $(".loading").fadeOut(200, function () {
                        $("#container_form").fadeOut(200, function () {
                            sendingInfo = false;
                            $("#sent").fadeIn(200);
                        });
                    });
                } else {
                    sendingInfo = false;
                    showErrorMessage("No se ha podido enviar tu consulta, intentalo nuevamente.");
                }
            });
        }
    });

    $("#showContact").click(function (e) {
        e.preventDefault();
        $("#container_form input, #container_form textarea").val("");
        $("#container_form select option[value=-1]").attr("selected", true);
        $("#sent").fadeOut(200, function () {
            $("#container_form").fadeIn(200);
        });

        selectDefault();
    });


    function validateForm() {
        $("#contact_form .error").removeClass("error");

        var firstNameInput = $('input[name="first-name"]');
        var emailInput = $('input[name="email"]');
        // var institutionInput = $('input[name="institution"]');
        var messageInput = $('textarea[name="message"]');
        var rightSelect = $('select[name="right"]');
        var institutionSelect = $('select[name="institution"]');

        var errorMessage = "";

        if (firstNameInput.val().length === 0) {
            firstNameInput.parent("div").addClass('error');
            firstNameInput.focus();
            errorMessage = "Debes ingresar tu nombre";
        } else if (emailInput.val().length === 0) {
            emailInput.parent("div").addClass('error');
            emailInput.focus();
            errorMessage = "Debes ingresar tu email";
        } else if (!validateEmail(emailInput.val())) {
            emailInput.parent("div").addClass('error');
            emailInput.focus();
            errorMessage = "El email ingresado no es válido";
        } else if (rightSelect.val() === "-1") {
            rightSelect.parent("div").addClass('error');
            errorMessage = "Debes seleccionar un derecho";
        } else if (institutionSelect.val() === "-1") {
            institutionSelect.parent("div").addClass('error');
            errorMessage = "Debes seleccionar la institución a la que perteneces";
        } else if (messageInput.val().length === 0) {
            messageInput.parent("div").addClass('error');
            messageInput.focus();
            errorMessage = "Debes ingresar tu consulta";
        } else {
            return true;
        }

        if (errorMessage.length > 0) {
            showErrorMessage(errorMessage);
        }

        return false;
    }


    function showErrorMessage(errorMessage) {
        $('.error-message.pink_bg p').html(errorMessage);
        $('.error-message.pink_bg').fadeIn();
        clearTimeout(hideMessageTimer);
        hideMessageTimer = setTimeout(function () {
            $('.error-message.pink_bg').fadeOut();
        }, 3000);
    }

    //Animate footer and nav on scroll
    $(".page_inner").scroll(function () {
        var scroll = $(this).scrollTop();
        if (scroll > 50) {
            $("nav,footer ul").addClass("hide");
        } else {
            $("nav,footer ul").removeClass("hide");
        }
    });

    $(".shareUrl").click(function (e) {
        var width = 640,
                height = 400;

        var url;
        var twUrl = "https://twitter.com/share?url=";
        var fbUrl = "http://www.facebook.com/sharer.php?u=";

        if ($(this).hasClass("fb")) {
            url = fbUrl + window.location.href;
        } else {
            url = twUrl + window.location.href;
        }

        // popup position
        var px = Math.floor(((screen.availWidth || 1024) - width) / 2),
                py = Math.floor(((screen.availHeight || 700) - height) / 2);

        // open popup
        var popup = window.open(url, "social",
                "width=" + width + ",height=" + height +
                ",left=" + px + ",top=" + py +
                ",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");

        if (popup) {
            popup.focus();
            if (e.preventDefault)
                e.preventDefault();
            e.returnValue = false;
        }

        return !!popup;
    });


    setTimeout(function () {

        $(".loading").fadeOut();
    }, 5000);

});

$("#search").click(function () {
    $("nav li input").toggleClass("show");
});


function selectDefault() {
    if (typeof id_category != "undefined") {
        $("#category option[value=" + id_category + "]").attr("selected", true);
    }

    if (typeof id_right != "undefined") {
        $("#right option[value=" + id_right + "]").attr("selected", true);
    }
}


