$(document).ready(function () {

    if (Cookies.get("email") && Cookies.get("password")) {
        $("#email").val(Cookies.get("email"));
        $("#password").val(Cookies.get("password"));
    }
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();
        if (validateForm()) {

            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/user/login.php",
                data: $("#loginForm").serialize(),
                dataType: "json"
            }).done(function (data) {
                if (data.result === true) {

                    if ($("#rememberme").is(":checked")) {
                        Cookies.set("email", $("#email").val());
                        Cookies.set("password", $("#password").val());
                    } else {
                        Cookies.remove("email");
                        Cookies.remove("password");
                    }

                    window.location.href = ADMIN_URL + "home"
                } else {
                    alert(INVALID_USER)
                }
            });
        }
    });
});



function validateForm() {
    var email = $("#email").val();
    var password = $("#password").val();

    if (!validateEmail(email)) {
        alert(INVALID_MAIL);
        return false;
    } else if (password == "") {
        alert(EMPTY_PASSWORD);
        return false;
    } else {
        return true;
    }
}