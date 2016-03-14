<?php

class DataInstitution {

    private $name;
    private $location;
    private $id;
    private $created;
    private $modified;

    function loadFromArray($institutionArray) {
        isset($institutionArray["id"]) ? $this->setId($institutionArray["id"]) : false;
        isset($institutionArray["name"]) ? $this->setName($institutionArray["name"]) : false;
        isset($institutionArray["location"]) ? $this->setLocation($institutionArray["location"]) : false;
        isset($institutionArray["crated"]) ? $this->setCreated($institutionArray["crated"]) : false;
        isset($institutionArray["modified"]) ? $this->setModified($institutionArray["modified"]) : false;
    }

    function getName() {
        return $this->name;
    }

    function getLocation() {
        return $this->location;
    }

    function getId() {
        return $this->id;
    }

    function getCreated() {
        return $this->created;
    }

    function getModified() {
        return $this->modified;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setModified($modified) {
        $this->modified = $modified;
    }

}
