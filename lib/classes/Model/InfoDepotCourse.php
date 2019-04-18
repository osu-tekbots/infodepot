<?php
namespace Model;

/**
 * Represents a course associated with an InfoDepotItem.
 */
class InfoDepotCourse {

    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $code;

    /**
     * Creates a new instance of a Course object.
     *
     * @param int $id the ID of the course
     * @param string $name the name of the course
     * @param string $code the code for the course
     */
    public function __construct($id, $name, $code) {
        $this->setId($id);
        $this->setName($name);
        $this->setCode($code);
    }

    /**
     * Get the value of id
     */ 
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName() {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode() {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }
}
