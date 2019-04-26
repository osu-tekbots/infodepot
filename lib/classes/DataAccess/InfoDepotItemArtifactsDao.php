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
        try {
			//4/26/19: implemented, needs testing.
			
			$sql = 'SELECT * FROM info_depot_item_artifact ';
            $sql .= 'WHERE idia_id = :id';

			$params = array(':id' => $itemId);
            $results = $this->conn->query($sql, $params);
            if (!$results || \count($results) == 0) {
                return false;
            }

            return \array_map('self::ExtractInfoDepotItemArtifactFromRow', $results);
        } catch (\Exception $e) {
            $this->logError('Failed to get all items: ' . $e->getMessage());
            return false;
        }
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
		try {
				//4/26/19: implemented, needs testing
			
				//idia_id is generated using a secure cryptic ID generator found in 
				//./shared/classes/Util/IdGenerator.php.
				$sql = 'INSERT INTO info_depot_item_artifact ';
				$sql .= '(idia_id, idia_idi_id, idia_description, idia_file, ';
				$sql .= 'idia_mime, idia_link) ';
				$sql .= 'VALUES (:id, :itemid, :description, :file, :mime, :link)';
				
				$params = array(
					':id' => $artifact->getId(),
					':itemid' => $artifact->getParentItem()->getId(),
					':description' => $artifact->getDescription(),
					':file' => $artifact->getFile(),
					':mime' => $artifact->getMime(),
					':link' => $artifact->getLink()
				);
				$this->conn->execute($sql, $params);

				return true;
			} catch (\Exception $e) {
				$this->logError('Failed to add new artifact: ' . $e->getMessage());

				return false;
        }
    }

    /**
     * Updates an existing info depot item artifact in the database.
     *
     * @param \Model\InfoDepotItemArtifact $artifact the artifact to update
     * @return boolean true if successful, false otherwise
     */
    public function updateInfoDepotItemArtifact($artifact) {
		try {
				//4/26/19: implemented, needs testing
			
				$sql = 'UPDATE info_depot_item_artifact SET ';
				$sql .= 'idia_description = :description, ';
				$sql .= 'idia_file = :file, ';
				$sql .= 'idia_mime = :mime, ';
				$sql .= 'idia_link = :link ';
				$sql .= 'WHERE idia_id = :id';

				$params = array(
					':id' => $artifact->getId(),
					':description' => $artifact->getDescription(),
					':file' => $artifact->getFile(),
					':mime' => $artifact->getMime(),
					':link' => $artifact->getLink()
				);
				$this->conn->execute($sql, $params);

				return true;
			} catch (\Exception $e) {
				$this->logError('Failed to update artifact: ' . $e->getMessage());

				return false;
        }
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
