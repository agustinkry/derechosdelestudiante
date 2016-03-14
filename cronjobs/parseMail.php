<?php

define('AVOID_SECURITY', true);

include_once '../include/include_backend.php';
include_once '../include/lib/PhpImap/Mailbox.php';
include_once '../include/lib/PhpImap/IncomingMail.php';

try {



    $mailbox = new PhpImap\Mailbox('{imap.vera.com.uy:110/pop3/novalidate-cert}INBOX', MAIL_USERNAME, MAIL_PASSWORD);
    $mails = array();

    $mailsIds = $mailbox->searchMailBox('UNSEEN');
    if (!$mailsIds) {
        die('Mailbox is empty');
    }


    $oDbaBckMessage = new DbaBckMessage();
    $oDbaBckPrejudice = new DbaBckPrejudice();
//Prejuicio:#
    echo("<pre>");
    foreach ($mailsIds as $mailId) {
        //get mail
        $mail = $mailbox->getMail($mailId);

        preg_match("/##(\d+)/", $mail->subject, $outputSubject);
        if ($outputSubject) {

            //primero chequear que el mail ya no este en la BD

            if (!$oDbaBckMessage->checkMsgExistByMailBoxId($mailId)) {

                $body = $mail->textPlain;

                preg_match_all("/(.*)(---RESPONDE ARRIBA DE ESTA LINEA---)(.*)/Us", $mail->textPlain, $outputBody);

                if ($outputBody && $outputBody[1] && $outputBody[1][0]) {
                    $body = $outputBody[1][0];
                }

                $body = trim($body);


                $prejudiceId = $outputSubject[1];


                //ahora chequear que el prejuicio exista

                if ($oDbaBckPrejudice->getPrejudice($prejudiceId) != null) {
                    $oMessage = new DataMessage();
                    $oMessage->setInBox(true);
                    $oMessage->setMailBoxId($mailId);
                    $oMessage->setMessage($body);
                    $oMessage->setPrejudiceId($prejudiceId);
                    $oMessage->setStatus(false);

                    //guardar mensaje
                    $oDbaBckMessage->createMessage($oMessage);
                    echo "Nuevo mensaje creado $mailId <br/>";
                }



                var_dump($prejudiceId);
                var_dump($body);
                echo "--------";
            } else {
                echo 'El mensaje ' . $mailId . ' ya existe y será ignoarado';
            }
        }
        /*

          var_dump($mail->subject); */
    }
    echo("</pre>");
//var_dump($mailsIds);
//$mailId = reset($mailsIds);
//??var_dump($mail->getAttachments());
//Nuevo comentario en ojo al prejuicio - prejuicio#1121
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}