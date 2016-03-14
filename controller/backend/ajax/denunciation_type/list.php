<?php

include_once '../../../../include/include_backend.php';

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'denunciation_type';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'id', 'dt' => 0),
    array('db' => 'name', 'dt' => 1),
    array(
        'db' => 'created',
        'dt' => 2,
        'formatter' => function( $d, $row ) {
            return date('d/m/Y H:i:s', strtotime($d));
        }
    ),
    array(
        'db' => 'modified',
        'dt' => 3,
        'formatter' => function( $d, $row ) {
            return date('d/m/Y H:i:s', strtotime($d));
        }
    ),
    array(
        'db' => 'id',
        'dt' => 4,
        'formatter' => function( $d, $row ) {
            return "<i class='action edit fa fa-edit' data='".$d."'></i>";
        }
    ),
    array(
        'db' => 'id',
        'dt' => 5,
        'formatter' => function( $d, $row ) {
            return "<i class='action delete fa fa-trash' data='".$d."'></i>";
        }
    )
);

// SQL server connection information
$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db' => DB_BASE,
    'host' => DB_SERVER
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);


