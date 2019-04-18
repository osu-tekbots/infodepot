<?php
namespace Model;

use Util\IdGenerator;

/**
 * Represents a comment made by a user on an item in the info depot.
 */
class InfoDepotComment {

    /** @var string */
    private $id;
    /** @var User */
    private $user;
    /** @var InfoDepotItem */
    private $depotItem;
    /** @var string */
    private $content;
    /** @var boolean */
    private $recommended;
    /** @var \DateTime */
    private $dateCreated;
    /** @var \DateTime */
    private $dateUpdated;

    /**
     * Constructs a new instance of a comment on an item in the info depot
     *
     * @param string|null $id the ID of the comment. If null, an ID will be generated
     */
    public function __construct($id = null) {
        if ($id == null) {
            $id = IdGenerator::generateSecureUniqueId();
        }
        $this->setId($id);
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
     * Get the value of user
     */ 
    public function getUser() {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of depotItem
     */ 
    public function getDepotItem() {
        return $this->depotItem;
    }

    /**
     * Set the value of depotItem
     *
     * @return  self
     */ 
    public function setDepotItem($depotItem) {
        $this->depotItem = $depotItem;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent() {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of recommended
     */ 
    public function isRecommended() {
        return $this->recommended;
    }

    /**
     * Set the value of recommended
     *
     * @return  self
     */ 
    public function setAsRecommended($recommended) {
        $this->recommended = $recommended;

        return $this;
    }

    /**
     * Get the value of dateCreated
     */ 
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * Set the value of dateCreated
     *
     * @return  self
     */ 
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get the value of dateUpdated
     */ 
    public function getDateUpdated() {
        return $this->dateUpdated;
    }

    /**
     * Set the value of dateUpdated
     *
     * @return  self
     */ 
    public function setDateUpdated($dateUpdated) {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }
}
