<?php

include_once '../../../../include/include_frontend.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

try {

    $name = filter_var($_POST["first-name"], FILTER_SANITIZE_STRING);
    $age = filter_var($_POST["age"], FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $institutionId = filter_var($_POST["institution"], FILTER_SANITIZE_NUMBER_INT);
    $grade = filter_var($_POST["grade"], FILTER_SANITIZE_NUMBER_INT);
    $location = filter_var($_POST["location"], FILTER_SANITIZE_NUMBER_INT);
    $rightId = filter_var($_POST["right"], FILTER_SANITIZE_NUMBER_INT);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

    if ($name && $email && $rightId && $institutionId && $message) {


        $oMessage = new DataMessage();
        $oMessage->setAge($age);
        $oMessage->setEmail($email);
        $oMessage->setGrade($grade);
        $oMessage->setInstitutionId($institutionId);
        $oMessage->setLocation($location);
        $oMessage->setMessage($message);
        $oMessage->setName($name);
        $oMessage->setRightId($rightId);
        $oMessage->setInBox(1);
        $oMessage->setStatus(1);

        //user who recive this mail

        $oDbaAdminUser = new DbaFrtAdminUser();
        $users = $oDbaAdminUser->getUsersRootAndWithInstitutionId($institutionId);

        $oDbaMessage = new DbaFrtMessage();
        $idMessage = $oDbaMessage->createMessage($oMessage);


        if (count($users) > 0) {

            $html = TplFrtMail::getContactMail($name, $age, $rightId, $institutionId, $location, $grade, $message);
            $oMail = UtlConfigMail::getConfiguredMail();

            foreach ($users as $oAdminUser) {
                $oMail->addAddress($oAdminUser->getEmail());
            }

            $oMail->addReplyTo("R" . $rightId . "M" . $idMessage . "-" . FROM_MAIL);

            $oMail->Subject = "Nueva Consulta";
            $oMail->Body = $html;
            $oMail->send();
        }
        //



        if ($idMessage > 0) {
            $response = array(
                "result" => true
            );
        } else {
            $response = array(
                "result" => false,
                "c" => 3
            );
        }
        /*
          $html = TplFrtMail::getContactMail($name, $age, $email, $institution, $subject, $message);
          $oMail = UtlConfigMail::getConfiguredMail();

          $oMail->addAddress($email);
          $oMail->Subject = $subject ? $subject : "Consulta sin asunto";
          $oMail->Body = $html;
          $oMail->addReplyTo($email);

          $oMail->send();

          $response = array(
          "result" => true
          );
         * */
    } else {
        $response = array(
            "result" => false,
            "c" => 2
        );
    }
} catch (Exception $exc) {
    $response = array(
        "result" => false,
        "c" => 1
    );
}

echo json_encode($response);

