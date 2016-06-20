$(document).ready(function () {
    $("#rightEdit").on("submit", function (e) {
        e.preventDefault();
        if (validateForm()) {
            $("#loading").fadeIn();
            tinyMCE.triggerSave();
            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/right/edit.php",
                data: $("#rightEdit").serialize(),
                dataType: "json"
            }).done(function (data) {
                $("#loading").fadeOut();
                if (data.result === true) {

                    if (data.creation == true) {
                        window.location.href = ADMIN_URL + "right/";
//                        $("#id").val(data.rightId);
//                        customAlert(RIGHT_CREATION_SUCCESS, false);
                        //message creation
                    } else {
                        customAlert(RIGHT_EDITION_SUCCESS, false);
                        // message edition    
                    }

                    if ($("#newImage").val() != "") {
                        $("#oldImage").val($("#newImage").val())
                        $("#newImage").val("")
                    }

                } else {
                    if (data.creation) {
                        customAlert(RIGHT_CREATION_ERROR, true);
                    } else {
                        customAlert(RIGHT_EDITION_ERROR, true);
                    }
                    //generic error
                }
            });



        }
    });

    //messageTpl

    $("#newMessage").on("submit", function (e) {
        e.preventDefault();
        var message = $("#messageInput").val();
        var id = $("#id").val();
        if (id == "") {
            customAlert(RIGHT_NO_SAVED, true);
        } else {

            if (message == "") {
                showInputError($("#messageInput"));
                customAlert(RIGHT_EMPTY_MESSAGE, true);
            } else {

                $("#loading").fadeIn();

                $.ajax({
                    type: "POST",
                    url: WEB_PATH + "controller/backend/ajax/right/replayMessage.php",
                    data: $("#newMessage").serialize(),
                    dataType: "json"
                }).done(function (data) {
                    $("#loading").fadeOut();
                    if (data.result === true) {
                        customAlert(RIGHT_MESSAGE_SUCCESS, false);

                        var $tpl = $("#messageTpl").clone();
                        $tpl.find(".messageText").html(message);
                        $tpl.attr("id", "");
                        $("#messagesContainer").append($tpl);
                        $tpl.slideDown();
                        $("#messageInput").val("");
                        $.fancybox.close()
                        //message creation
                    } else {
                        customAlert(RIGHT_MESSAGE_ERROR, true);
                        //generic error
                    }
                });


            }
        }
    });


    $('.deleteMessage').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var messageId = $this.siblings("input.messageId").val();
        showConfirmation(GENERIC_ATENTION_MSG, RIGHT_MESSAGE_DELETE, function () {
            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/right/deleteMessage.php",
                data: {"messageId": messageId},
                dataType: "json"
            }).done(function (data) {
                $("#loading").fadeOut();
                if (data.result === true) {
                    $this.parents(".conv").slideUp()
                    $(".parent_id_" + messageId).slideUp();
                    customAlert(RIGHT_MESSAGE_DELETE_SUCCESS, false);
                    //message creation
                } else {
                    customAlert(RIGHT_MESSAGE_DELETE_ERROR, true);
                    //generic error
                }
            });
        });
    });

    tinymce.init({
        selector: '#description',
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | media | forecolor backcolor'
    });


    $(".fancybox").fancybox({
        maxWidth: 800,
        maxHeight: 600,
        fitToView: false,
        width: '70%',
        height: '70%',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none'
    });


    $(".replyMessage").click(function () {
        var user_email = $(this).siblings(".message_user_email").children("b").html();
        var user_text = $(this).siblings(".message_user_text").html();
        $("#newMessage .userEmail").html(user_email).val(user_email);
        $("#userMessage").html(user_text);
        $("#rightId").val($("#id").val());
        $("#parentMessageId").val($(this).siblings(".messageId").val());
    });

    $(".editMessage").click(function () {
        var $this = $(this);
        var messageId = $this.siblings("input.messageId").val();
        $("#messageEditId").val(messageId);
        var user_text = $this.siblings(".message_user_text").html();
        console.log(user_text)
        $("#messageEditInput").val(user_text);
    });

    $("#editMessage").on("submit", function (e) {
        e.preventDefault();
        var message = $("#messageEditInput").val();
        if (message == "") {
            showInputError($("#messageEditInput"));
            customAlert(RIGHT_EMPTY_MESSAGE, true);
        } else {

            $("#loading").fadeIn();

            $.ajax({
                type: "POST",
                url: WEB_PATH + "controller/backend/ajax/right/editMessage.php",
                data: $("#editMessage").serialize(),
                dataType: "json"
            }).done(function (data) {
                $("#loading").fadeOut();
                if (data.result === true) {
                    customAlert(RIGHT_MESSAGE_EDIT_SUCCESS, false);
                    $("input.messageId[value='"+$("#messageEditId").val()+"']").siblings('.message_user_text').html(message);
                    $.fancybox.close();
                    //message creation
                } else {
                    customAlert(RIGHT_MESSAGE_EDIT_ERROR, true);
                    //generic error
                }
            });


        }

    });
});



function validateForm() {
    var title = $("#title").val();
    var description = $("#description").val();


    hideInputError($("#rightEdit"));

    if (title == "") {
        showInputError($("#title"));
        customAlert(EMPTY_TITLE, true);
        return false;
    } else if (description == "") {
        showInputError($("#description"));
        customAlert(EMPTY_DESCRIPTION, true);
        return false;
    } else if ($("input[name='category[]']:checked").size() == 0) {
        customAlert(EMPTY_CATEGORY, true);
    } else {
        return true;
    }
}