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
    private $name;
    private $age;
    private $location;
    private $institutionId;
    private $grade;

    function loadFromArray($messageArray) {
        isset($messageArray["id"]) ? $this->setId($messageArray["id"]) : false;
        isset($messageArray["right_id"]) ? $this->setRightId($messageArray["right_id"]) : false;
        isset($messageArray["message"]) ? $this->setMessage($messageArray["message"]) : false;
        isset($messageArray["inBox"]) ? $this->setInBox($messageArray["inBox"]) : false;
        isset($messageArray["status"]) ? $this->setStatus($messageArray["status"]) : false;
        isset($messageArray["email"]) ? $this->setEmail($messageArray["email"]) : false;
        isset($messageArray["mailBoxId"]) ? $this->setMailBoxId($messageArray["mailBoxId"]) : false;
        isset($messageArray["parent_message_id"]) ? $this->setParentMessageId($messageArray["parent_message_id"]) : false;
        isset($messageArray["name"]) ? $this->setName($messageArray["name"]) : false;
        isset($messageArray["age"]) ? $this->setAge($messageArray["age"]) : false;
        isset($messageArray["location"]) ? $this->setLocation($messageArray["location"]) : false;
        isset($messageArray["institution_id"]) ? $this->setInstitutionId($messageArray["institution_id"]) : false;
        isset($messageArray["grade"]) ? $this->setGrade($messageArray["grade"]) : false;
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

    function getName() {
        return $this->name;
    }

    function getAge() {
        return $this->age;
    }

    function getLocation() {
        return $this->location;
    }

    function getInstitutionId() {
        return $this->institutionId;
    }

    function getGrade() {
        return $this->grade;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setAge($age) {
        $this->age = $age;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setInstitutionId($institutionId) {
        $this->institutionId = $institutionId;
    }

    function setGrade($grade) {
        $this->grade = $grade;
    }


}
