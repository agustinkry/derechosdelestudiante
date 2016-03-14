var hasImage = false;

$(document).ready(function () {

    $("#denouncedEdit").on("submit", function (e) {
        e.preventDefault();
        if (validateForm()) {
            $("#loading").fadeIn();
            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/denunciation_type/edit.php",
                data: $("#denouncedEdit").serialize(),
                dataType: "json"
            }).done(function (data) {
                $("#loading").fadeOut();
                if (data.result === true) {

                    if (data.creation == true) {
                        window.location.href = ADMIN_URL + "denunciation_type/";
//                        $("#id").val(data.denouncedId);
//                        customAlert(DENOUNCED_CREATION_SUCCESS, false);
                        //message creation
                    } else {
                        customAlert(DENUNCIATION_TYPE_EDITION_SUCCESS, false);
                        // message edition    
                    }


                } else {
                    if (data.creation) {
                        customAlert(DENUNCIATION_TYPE_CREATION_ERROR, true);
                    } else {
                        customAlert(DENUNCIATION_TYPE_EDITION_ERROR, true);
                    }
                    //generic error
                }
            });
        }
    });
});



function validateForm() {
    var name = $("#name").val();
    var description = $("#description").val();


    hideInputError($("#denouncedEdit"));

    if (name == "") {
        showInputError($("#name"));
        customAlert(EMPTY_NAME, true);
        return false;
    }else if (description == "") {
        showInputError($("#description"));
        customAlert(EMPTY_DESCRIPTION, true);
        return false;
    } else {
        return true;
    }
}