<?php

class DataRight {

    private $id;
    private $title;
    private $description;
    private $categories;
    
    function loadFromArray($rightArray) {
        $this->setId($rightArray["id"]);
        $this->setTitle($rightArray["title"]);
        $this->setDescription($rightArray["description"]);
    }
    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setDescription($description) {
        $this->description = $description;
    }
    
    function getCategories() {
        return $this->categories;
    }

    function setCategories($categories) {
        $this->categories = $categories;
    }
}
