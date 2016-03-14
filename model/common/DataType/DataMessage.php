<?php

class DataMessage {

    private $id;
    private $rightId;
    private $message;
    private $inBox;
    private $status;
    private $mailBoxId;
    private $email;
    private $parentMessageId;

    function loadFromArray($messageArray) {
        $this->setId($messageArray["id"]);
        $this->setRightId($messageArray["right_id"]);
        $this->setMessage($messageArray["message"]);
        $this->setInBox($messageArray["inBox"]);
        $this->setStatus($messageArray["status"]);
        $this->setEmail($messageArray["email"]);
        $this->setMailBoxId($messageArray["mailBoxId"]);
        $this->setParentMessageId($messageArray["parent_message_id"]);
    }

    function getId() {
        return $this->id;
    }

    function getMessage() {
        return $this->message;
    }

    function getInBox() {
        return $this->inBox;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setInBox($inBox) {
        $this->inBox = $inBox;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getMailBoxId() {
        return $this->mailBoxId;
    }

    function setMailBoxId($mailBoxId) {
        $this->mailBoxId = $mailBoxId;
    }

    function getRightId() {
        return $this->rightId;
    }

    function setRightId($rightId) {
        $this->rightId = $rightId;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getParentMessageId() {
        return $this->parentMessageId;
    }

    function setParentMessageId($parentMessageId) {
        $this->parentMessageId = $parentMessageId;
    }

}
