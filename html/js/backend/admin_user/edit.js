$(document).ready(function () {
    $("#userEdit").on("submit", function (e) {
        e.preventDefault();
        if (validateForm()) {
            $("#loading").fadeIn();
            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/user/edit.php",
                data: $("#userEdit").serialize(),
                dataType: "json"
            }).done(function (data) {
                $("#loading").fadeOut();
                if (data.result === true) {

                    if (data.creation == true) {
//                        $("#id").val(data.userId);
//                        customAlert(USER_CREATION_SUCCESS, false);
                        window.location.href = ADMIN_URL + "admin_user";
                        //message creation
                    } else {
                        customAlert(USER_EDITION_SUCCESS, false);
                        if (data.needsReload) {
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        }
                        // message edition    
                    }


                } else if (data.mailExits == true) {
                    showInputError($("#email"));
                    customAlert(USER_DUPLICATED_MAIL, true);
                    //message duplicated mail
                } else {
                    if (data.creation) {
                        customAlert(USER_CREATION_ERROR, true);
                    } else {
                        customAlert(USER_EDITION_ERROR, true);
                    }
                    //generic error
                }
            });
        }
    });

    
    
});



function validateForm() {
    var name = $("#name").val();
    var lastName = $("#lastName").val();
    var email = $("#email").val();

    hideInputError($("#userEdit"));

    if (name == "") {
        showInputError($("#name"));
        customAlert(EMPTY_NAME, true);
        return false;
    } else if (lastName == "") {
        showInputError($("#lastName"));
        customAlert(EMPTY_LAST_NAME, true);
        return false;
    } else if (!validateEmail(email)) {
        showInputError($("#email"));
        customAlert(INVALID_MAIL, true);
        return false;
    }  else {
        return true;
    }
}