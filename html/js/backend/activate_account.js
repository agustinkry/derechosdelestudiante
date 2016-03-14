$(document).ready(function () {
    $("#loading").fadeOut();

    $("#loginForm").on("submit", function (e) {
        e.preventDefault();
        hideInputError($("#loginForm"));
        if ($("#password").val() == "") {
            customAlert(EMPTY_PASSWORD, true);
            showInputError($("#password"));
        } else if ($("#password").val() != $("#re-password").val()) {
            customAlert(PASSWORD_NO_MATCHING, true);
            showInputError($("#password"));
        } else {
            $("#loading").fadeIn();
            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/user/activate_account.php",
                data: $("#loginForm").serialize(),
                dataType: "json"
            }).done(function (data) {
                $("#loading").fadeOut();
                if (data.result === true) {
                    window.location.href = ADMIN_URL + "home/";
                } else {
                    customAlert(GENERIC_ERROR, true);
                }
            });
        }
    });
});
