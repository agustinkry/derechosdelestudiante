<?php

class DataDenounced{
    private $id;
    private $name;
    private $page;
    private $description;
    private $email;
    private $image;
    private $denunciationType;
//    private $created;
//    private $modified;
//    
    function loadFromArray($denouncedArray) {
        $this->setId($denouncedArray["id"]);
        $this->setName($denouncedArray["name"]);
        $this->setPage($denouncedArray["urlPage"]);
        $this->setEmail($denouncedArray["email"]);
        $this->setDescription($denouncedArray["description"]);
        $this->setImage($denouncedArray["image"]);
        $this->setDenunciationType($denouncedArray["denunciation_type"]);
        
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPage() {
        return $this->page;
    }

    function getDescription() {
        return $this->description;
    }

    function getEmail() {
        return $this->email;
    }

    function getCreated() {
        return $this->created;
    }

    function getModified() {
        return $this->modified;
    }
    
    function getImage() {
        return $this->image;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPage($page) {
        $this->page = $page;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setModified($modified) {
        $this->modified = $modified;
    }
    
    function setImage($image) {
        $this->image = $image;
    }
    
    function getDenunciationType() {
        return $this->denunciationType;
    }

    function setDenunciationType($denunciationType) {
        $this->denunciationType = $denunciationType;
    }



}