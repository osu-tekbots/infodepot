<?php
namespace Model;

use Util\IdGenerator;

/**
 * Represents an artifact that belongs to an item in the info depot.
 */
class InfoDepotItemArtifact {

    /** @var string */
    private $id;
    /** @var InfoDepotItem */
    private $parentItem;
    /** @var string */
    private $description;
    /** @var string */
    private $file;
    /** @var string */
    private $mime;
    /** @var string */
    private $link;

    /**
     * Creates a new instance of an artifact belonging to an info depot item.
     * 
     * The constructor also takes a reference to the item that it belongs to.
     *
     * @param string|null $id the ID of the artifact. If null, an ID will be generated.
     * @param InfoDepotItem|null $parentItem the item the artifact belongs to
     */
    public function __construct($id = null, $parentItem = null) {
        if ($id == null) {
            $id = IdGenerator::generateSecureUniqueId();
        }
        $this->setId($id);
        $this->setParentItem($parentItem);
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
     * Get the value of parentItem
     */ 
    public function getParentItem() {
        return $this->parentItem;
    }

    /**
     * Set the value of parentItem
     *
     * @return  self
     */ 
    public function setParentItem($parentItem) {
        $this->parentItem = $parentItem;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of file
     */ 
    public function getFile() {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */ 
    public function setFile($file) {
        $this->file = $file;

        return $this;
    }

    /**
     * Get the value of mime
     */ 
    public function getMime() {
        return $this->mime;
    }

    /**
     * Set the value of mime
     *
     * @return  self
     */ 
    public function setMime($mime) {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink() {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link) {
        $this->link = $link;

        return $this;
    }
}
