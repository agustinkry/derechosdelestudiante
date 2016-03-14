<?php

class DataAdminUser {

    private $id;
    private $name;
    private $lastName;
    private $email;
    private $status;
    private $root;
    private $removable;
    private $createdBy;

    function loadFromArray($userArray) {
        $this->setId($userArray["id"]);
        $this->setName($userArray["name"]);
        $this->setLastName($userArray["lastName"]);
        $this->setEmail($userArray["email"]);
        $this->setStatus($userArray["status"]);
        $this->setRoot($userArray["root"]);
        isset($userArray["removable"]) ? $this->setRemovable($userArray["removable"]) : false;
        isset($userArray["createdBy"]) ? $this->setCreatedBy($userArray["createdBy"]) : false;
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


}
