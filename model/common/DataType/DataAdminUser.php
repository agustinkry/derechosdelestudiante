<?php

class DataAdminUser {

    private $id;
    private $name;
    private $lastName;
    private $email;
    private $status;
    private $root;
    private $institutionId;
    private $removable;
    private $createdBy;

    function loadFromArray($userArray) {

        isset($userArray["id"]) ? $this->setId($userArray["id"]) : false;
        isset($userArray["name"]) ? $this->setName($userArray["name"]) : false;
        isset($userArray["lastName"]) ? $this->setLastName($userArray["lastName"]) : false;
        isset($userArray["email"]) ? $this->setEmail($userArray["email"]) : false;
        isset($userArray["status"]) ? $this->setStatus($userArray["status"]) : false;
        isset($userArray["root"]) ? $this->setRoot($userArray["root"]) : false;
        isset($userArray["removable"]) ? $this->setRemovable($userArray["removable"]) : false;
        isset($userArray["createdBy"]) ? $this->setCreatedBy($userArray["createdBy"]) : false;
        isset($userArray["institution_id"]) ? $this->setInstitutionId($userArray["institution_id"]) : false;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getName() {
        return $this->name;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getRoot() {
        return $this->root;
    }

    function setRoot($root) {
        $this->root = $root;
    }

    function getRemovable() {
        return $this->removable;
    }

    function setRemovable($removable) {
        $this->removable = $removable;
    }

    function getCreatedBy() {
        return $this->createdBy;
    }

    function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    function getInstitutionId() {
        return $this->institutionId;
    }

    function setInstitutionId($institutionId) {
        $this->institutionId = $institutionId;
    }

}
