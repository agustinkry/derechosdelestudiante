$(document).ready(function () {
    var table = $('#example0').DataTable({
        "language": {
            "url": WEB_PATH + "html/js/datatables/Spanish.json"
        },
        "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 1
            },{
                "searchable": false,
                "orderable": false,
                "targets": -1
            }, {
                "searchable": false,
                "orderable": false,
                "targets": -2
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": WEB_PATH + "controller/backend/ajax/institution/list.php"

    });
    
    //edit action
    $("table.table").on("click", "i.action", function () {
        var id = $(this).attr("data");
        
        if ($(this).hasClass("delete")) {
            
            showConfirmation(GENERIC_ATENTION_MSG, GENERIC_DELETE_MSG, function () {
                $("#loading").fadeIn();
                $.ajax({
                    type: "POST",
                    url: WEB_PATH + "controller/backend/ajax/institution/delete.php",
                    data: {"id":id},
                    dataType: "json"
                }).done(function (data) {
                    $("#loading").fadeOut();
                    if (data.result === true) {
                        table.ajax.reload();
                    } else {
                        customAlert(GENERIC_ERROR, true);
                        //generic error
                    }
                });
            });
        } else {
            window.location.href = ADMIN_URL + "institution/" + id;
        }

    });
});