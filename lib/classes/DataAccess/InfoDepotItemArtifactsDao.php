<?php
namespace DataAccess;

use Model\InfoDepotItemArtifact;

/**
 * Houses the logic for database interactions relating to artifacts for items in the OSU info depot system.
 */
class InfoDepotItemArtifactsDao {

    /** @var DatabaseConnection */
    private $conn;

    /** @var \Util\Logger */
    private $logger;

    /** @var boolean */
    private $echoOnError;

    /**
     * Constructs a new instance of the data access object for item artifacts in the info depot.
     *
     * @param DatabaseConnection $connection the connection to the database
     * @param \Util\Logger $logger logger used to log messages and errors
     * @param boolean $echoOnError flag to determine whether to echo error messages to the output buffer
     */
    public function __construct($connection, $logger = null, $echoOnError = false) {
        $this->conn = $connection;
        $this->logger = $logger;
        $this->echoOnError = $echoOnError;
    }

    /**
     * Fetches all the artifacts associated with an item in the info depot.
     *
     * @param string $itemId the ID of the item whose artifacts the function will fetch
     * @return \Model\InfoDepotItemArtifact[]|boolean an array of artifacts if successful, false otherwise
     */
    public function getInfoDepotArtifactsForItem($itemId) {
        // TODO: implement this stub
    }

    /**
     * Adds a new entry for an artifact associated with an item in the info depot.
     * 
     * The item the artifact is associated with is included as a reference to an InfoDepotItem in the provided 
     * InfoDepotItemArtifact itself.
     *
     * @param \Model\InfoDepotItemArtifact $artifact the artifact to add
     * @return boolean true of successful, false otherwise
     */
    public function addNewInfoDepotItemArtifact($artifact) {
        // TODO: implement this stub
    }

    /**
     * Updates an existing info depot item artifact in the database.
     *
     * @param \Model\InfoDepotItemArtifact $artifact the artifact to update
     * @return boolean true if successful, false otherwise
     */
    public function updateInfoDepotItemArtifact($artifact) {
        // TODO: implement this stub
    }

    /**
     * Creates a new InfoDepotItemArtifact object from the values of a row in the database.
     * 
     * The artifact will not have the associated InfoDepotItem set. This helps us avoid creating duplicate objects
     * when running queries on the database. The item associated with the artifact will need to be set after it
     * has been fetched.
     *
     * @param mixed[] $row the row in the database to extract the values from
     * @return \Model\InfoDepotItemArtifact
     */
    public static function ExtractInfoDepotItemArtifactFromRow($row) {
        return (new InfoDepotItemArtifact($row['idia_id']))
            ->setDescription($row['idia_description'])
            ->setFile($row['idia_file'])
            ->setMime($row['idia_mime'])
            ->setLink($row['idia_link']);
    }

    /**
     * Logs an error message if there is a logger set in the DAO.
     * 
     * This will also echo the error message if the echoOnError property is set to true.
     *
     * @param string $message the message to log
     * @return void
     */
    private function logError($message) {
        if ($this->logger != null) {
            $this->logger->error($message);
        }
        if ($this->echoOnError == true) {
            echo "$message\n";
        }
    }
}
