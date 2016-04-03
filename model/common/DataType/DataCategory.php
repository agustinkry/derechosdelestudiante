<?php

class DataCategory {

    private $id;
    private $name;
    private $parentId;
    private $description;
    private $created;
    private $modified;
    private $childrenCategories;
    private $icon;

    function loadFromArray($categoryArray) {
        isset($categoryArray["id"]) ? $this->setId($categoryArray["id"]) : false;
        isset($categoryArray["name"]) ? $this->setName($categoryArray["name"]) : false;
        isset($categoryArray["parent_id"]) ? $this->setParentId($categoryArray["parent_id"]) : false;
        isset($categoryArray["description"]) ? $this->setDescription($categoryArray["description"]) : false;
        isset($categoryArray["crated"]) ? $this->setCreated($categoryArray["crated"]) : false;
        isset($categoryArray["modified"]) ? $this->setModified($categoryArray["modified"]) : false;
        isset($categoryArray["icon"]) ? $this->setIcon($categoryArray["icon"]) : false;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getParentId() {
        return $this->parentId;
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

    function setParentId($parentId) {
        $this->parentId = $parentId;
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

    function getChildrenCategories() {
        return $this->childrenCategories;
    }

    function setChildrenCategories($childrenCategories) {
        $this->childrenCategories = $childrenCategories;
    }

    function getIcon() {
        return $this->icon;
    }

    function setIcon($icon) {
        $this->icon = $icon;
    }

}
