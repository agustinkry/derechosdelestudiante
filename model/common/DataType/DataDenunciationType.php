<?php

class DataDenunciationType {

    private $id;
    private $name;
    private $description;
    private $created;
    private $modified;
    
    function loadFromArray($denunciationTypeArray) {
       isset($denunciationTypeArray["id"]) ? $this->setId($denunciationTypeArray["id"]) : false;
       isset($denunciationTypeArray["name"]) ? $this->setName($denunciationTypeArray["name"]) : false; 
       isset($denunciationTypeArray["description"]) ? $this->setDescription($denunciationTypeArray["description"]) : false;
       isset($denunciationTypeArray["crated"]) ? $this->setCreated($denunciationTypeArray["crated"]) : false;
       isset($denunciationTypeArray["modified"]) ? $this->setModified($denunciationTypeArray["modified"]) : false;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getCreated() {
        return $this->created;
    }

    function getModified() {
        return $this->modified;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setModified($modified) {
        $this->modified = $modified;
    }



}
