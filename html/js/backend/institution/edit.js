$(document).ready(function () {
    $("#institutionEdit").on("submit", function (e) {
        e.preventDefault();
        if (validateForm()) {
            $("#loading").fadeIn();
            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/institution/edit.php",
                data: $("#institutionEdit").serialize(),
                dataType: "json"
            }).done(function (data) {
                $("#loading").fadeOut();
                if (data.result === true) {

                    if (data.creation == true) {
                        window.location.href = ADMIN_URL + "institution/";
                    } else {
                        customAlert(INSTITUTION_EDITION_SUCCESS, false);
                        // message edition    
                    }


                } else {
                    if (data.creation) {
                        customAlert(INSTITUTION_CREATION_ERROR, true);
                    } else {
                        customAlert(INSTITUTION_EDITION_ERROR, true);
                    }
                    //generic error
                }
            });
        }
    });
});



function validateForm() {
    var name = $("#name").val();
    var location = $("#location").val();


    hideInputError($("#institutionEdit"));

    if (name == "") {
        showInputError($("#name"));
        customAlert(EMPTY_NAME, true);
        return false;
    } else if (location == "") {
        showInputError($("#location"));
        customAlert(EMPTY_LOCATION, true);
        return false;
    } else {
        return true;
    }
}