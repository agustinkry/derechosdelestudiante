<?php

if (!defined('AVOID_SECURITY') || AVOID_SECURITY !== true) {
    if (!UtlSession::getBckUser()) {
        if ((isset($_GET['fromajax']) && $_GET['fromajax'] == 'true') || (isset($_POST['fromajax']) && $_POST['fromajax'] == 'true')) {
            echo '<script>document.location'.ADMIN_URL.';</script>';
            die();
        } else {
            header("Location: " . ADMIN_URL);
        }
    }
}