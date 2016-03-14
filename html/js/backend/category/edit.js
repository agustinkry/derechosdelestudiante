$(document).ready(function () {

    $("#categoryEdit").on("submit", function (e) {
        e.preventDefault();
        if (validateForm()) {
            $("#loading").fadeIn();
            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/category/edit.php",
                data: $("#categoryEdit").serialize(),
                dataType: "json"
            }).done(function (data) {
                $("#loading").fadeOut();
                if (data.result === true) {

                    if (data.creation == true) {
                        window.location.href = ADMIN_URL + "category/";
                        //message creation
                    } else {
                        customAlert(CATEGORY_EDITION_SUCCESS, false);
                        // message edition    
                    }

                } else {
                    if (data.creation) {
                        customAlert(CATEGORY_CREATION_ERROR, true);
                    } else {
                        customAlert(CATEGORY_EDITION_ERROR, true);
                    }
                    //generic error
                }
            });
        }
    });
});



function validateForm() {
    var nombre = $("#name").val();
    var description = $("#description").val();

    hideInputError($("#categoryEdit"));

    if (nombre == "") {
        showInputError($("#name"));
        customAlert(EMPTY_NAME, true);
        return false;
    } else if (description == "") {
        showInputError($("#description"));
        customAlert(EMPTY_DESCRIPTION, true);
        return false;
    } else {
        return true;
    }
}