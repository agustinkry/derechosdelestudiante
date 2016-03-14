$(document).ready(function () {
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();
        if ($("#password").val() == "") {
            alert(EMPTY_PASSWORD);
        } else if ($("#password").val() != $("#re-password").val()) {
            alert(PASSWORD_NO_MATCHING);
        } else {
            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/user/recovery_password.php",
                data: $("#loginForm").serialize(),
                dataType: "json"
            }).done(function (data) {
                if (data.result === true) {
                    window.location.href = ADMIN_URL+"home/";
                } else {
                    alert(GENERIC_ERROR);
                }
            });
        }
    });
});
