
var timeOut;
function customAlert(message, isError) {
    $("#alerttop").fadeIn();
    $("#alerttopMessage").html(message);
    if (isError) {
        $("#alerttop").removeClass("alert3").addClass("alert6");
        $("#alerttopIco").removeClass("fa-check").addClass("fa-lock");
    } else {
        $("#alerttop").removeClass("alert6").addClass("alert3");
        $("#alerttopIco").removeClass("fa-lock").addClass("fa-check");
    }
    
    clearTimeout(timeOut);
    
    timeOut = setTimeout(function(){
        $("#alerttop").fadeOut();
    }, 3000);
}


function showInputError($input){
    $input.parents(".form-group").addClass("has-error");
    $input.focus();
}

function hideInputError($form){
    $form.children(".form-group.has-error").removeClass("has-error");
}



function showConfirmation(title, message, okCallback){
    
    $("#confirmModal .modal-title").html(title);
    
    $("#confirmModal .modal-body").html(message);
    
    $("#confirmModal .btn-default").on("click", function(){
        $("#confirmModal .btn-default").off("click");
        okCallback();
    });
    
    $("#confirmModal .btn-white").on("click", function(){
        $("#confirmModal .btn-default").off("click");
    });
    
    $("#openConfirmModal").click();
}