<?php
namespace Model;

use Util\IdGenerator;

/**
 * Represents an item in the info depot. An item is a submission by a user to the depot.
 */
class InfoDepotItem {

    /** @var string */
    private $id;
    /** @var User */
    private $user;
    /** @var string */
    private $title;
    /** @var string */
    private $details;
    /** @var InfoDepotCourse */
    private $course;
    /** @var \DateTime */
    private $dateCreated;
    /** @var \DateTime */
    private $dateUpdated;
    /** @var InfoDepotItemArtifact[] */
    private $artifacts = array();
    /** @var int */
    private $helpfulCount = 0;
    /** @var int */
    private $unhelpfulCount = 0;
    /** @var InfoDepotComment[] */
    private $comments = array();

    /**
     * Constructs a new instance of an item in the info depot. 
     *
     * @param string|null $id the ID of the item. If null, an ID will be generated.
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
     * Get the value of title
     */ 
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of details
     */
    public function getDetails() {
        return $this->details;
    }

    /**
     * Set the value of details
     *
     * @return  self
     */
    public function setDetails($details) {
        $this->details = $details;

        return $this;
    }

    /**
     * Get the value of course
     */ 
    public function getCourse() {
        return $this->course;
    }

    /**
     * Set the value of course
     *
     * @return  self
     */ 
    public function setCourse($course) {
        $this->course = $course;

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

    /**
     * Get the value of artifacts
     */ 
    public function getArtifacts() {
        return $this->artifacts;
    }

    /**
     * Set the value of artifacts
     *
     * @param InfoDepotItemArtifact[] $artifacts
     * @return  self
     */ 
    public function setArtifacts($artifacts) {
        foreach ($artifacts as $a) {
            $a->setParentItem($this);
        }
        $this->artifacts = $artifacts;

        return $this;
    }

    /**
     * Get the value of helpfulCount
     */ 
    public function getHelpfulCount() {
        return $this->helpfulCount;
    }

    /**
     * Set the value of helpfulCount
     *
     * @return  self
     */ 
    public function setHelpfulCount($helpfulCount) {
        $this->helpfulCount = $helpfulCount;

        return $this;
    }

    /**
     * Get the value of unhelpfulCount
     */ 
    public function getUnhelpfulCount() {
        return $this->unhelpfulCount;
    }

    /**
     * Set the value of unhelpfulCount
     *
     * @return  self
     */ 
    public function setUnhelpfulCount($unhelpfulCount) {
        $this->unhelpfulCount = $unhelpfulCount;

        return $this;
    }

    /**
     * Get the value of comments
     */ 
    public function getComments() {
        return $this->comments;
    }

    /**
     * Set the value of comments
     *
     * @return  self
     */ 
    public function setComments($comments) {
        $this->comments = $comments;

        return $this;
    }
}
