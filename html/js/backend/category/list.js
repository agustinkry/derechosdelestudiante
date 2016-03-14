var dTable;
$(document).ready(function () {
    dTable = $('#tableNew').DataTable({
        "language": {
            "url": WEB_PATH + "html/js/datatables/Spanish.json"
        },
        "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": -1,
                "data": null,
                "defaultContent": "<i class='action delete fa fa-trash'></i>"
            }, {
                "searchable": false,
                "orderable": false,
                "targets": -2,
                "data": null,
                "defaultContent": "<i class='action edit fa fa-edit'></i>"
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": WEB_PATH + "controller/backend/ajax/category/list.php"
    });
    
    //edit action
    $("table.table").on("click", "i.action", function () {
        var id = $(this).parent().siblings(":first").html();
        var $row = $(this).parent();
        var $table = $row.parents("table");
        
        if ($(this).hasClass("delete")) {
            
            showConfirmation(GENERIC_ATENTION_MSG, GENERIC_DELETE_MSG, function () {
                $("#loading").fadeIn();
                $.ajax({
                    type: "POST",
                    url: WEB_PATH + "controller/backend/ajax/category/delete.php",
                    data: {"id":id},
                    dataType: "json"
                }).done(function (data) {
                    $("#loading").fadeOut();
                    if (data.result === true) {
                        dTable.ajax.reload();
                    } else {
                        customAlert(GENERIC_ERROR, true);
                        //generic error
                    }
                });
            });
        } else {
            window.location.href = ADMIN_URL + "category/" + id;
        }

    });


});