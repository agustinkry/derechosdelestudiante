<?php

include_once '../../../include/include_backend.php';

$oTplBckAdminUser = new TplBckAdminUser();

$oUser = UtlSession::getBckUser();
echo $oTplBckAdminUser->getList();
