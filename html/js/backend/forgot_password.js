$(document).ready(function () {
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();
        if (validateEmail($("#email").val())) {
            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/user/forgot_password.php",
                data: $("#loginForm").serialize(),
                dataType: "json"
            }).done(function (data) {
                if (data.result === true) {
                    alert(FORGOT_PASSWORD_OK)
                    window.location.href = ADMIN_URL 
                } else {
                    alert(GENERIC_ERROR)
                }
            });
        }else{
            alert(INVALID_MAIL);
        }
    });
});
