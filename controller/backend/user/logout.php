<?php

include_once '../../../include/include_backend.php';

UtlSession::deleteBckUser();
header("Location: ".ADMIN_URL);
