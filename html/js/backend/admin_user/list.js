$(document).ready(function () {


    function initTable() {
        $('#example0').dataTable().fnDestroy();
        $('#example0').DataTable({
            "language": {
                "url": WEB_PATH + "html/js/datatables/Spanish.json"
            },
            "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": -1
                }, {
                    "searchable": false,
                    "orderable": false,
                    "targets": -2
                }
            ]

        });

    }
    
    initTable();
    //edit action
    $("table.table").on("click", "i.action", function () {
        var id = $(this).parent().siblings(":first").html();
        var $row = $(this).parents("tr");

        if ($(this).hasClass("delete")) {
            showConfirmation(GENERIC_ATENTION_MSG, GENERIC_DELETE_MSG, function () {
                $("#loading").fadeIn(400, function () {
                    $.ajax({
                        type: "POST",
                        url: WEB_PATH + "controller/backend/ajax/user/delete.php",
                        data: {"id": id},
                        dataType: "json"
                    }).done(function (data) {
                        $("#loading").fadeOut();

                        if (data.result === true) {
                            $row.remove();
                            initTable();
                        } else if (data.msg) {
                            customAlert(data.msg, true);
                            //generic error
                        } else {
                            customAlert(GENERIC_ERROR, true);
                        }
                    });
                });
            });
        } else {
            window.location.href = ADMIN_URL + "admin_user/" + id;
        }

    });
});