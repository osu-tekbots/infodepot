<?php
namespace DataAccess;

use Model\InfoDepotComment;

/**
 * Houses the logic for database interactions relating to comments in the OSU info depot system.
 */
class InfoDepotCommentsDao {

    /** @var DatabaseConnection */
    private $conn;

    /** @var \Util\Logger */
    private $logger;

    /** @var boolean */
    private $echoOnError;

    /**
     * Constructs a new instance of the data access object for comments on items in the info depot.
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
     * Fetches all the comments associated with the provided info depot item
     *
     * @param \Model\InfoDepotItem $item the item whose comments the function should fetch
     * @return \Model\InfoDepotComment[]|boolean an array of comments if successful, false otherwise
     */
    public function getInfoDepotCommentsForItem($item) {
        try {
			//4/26/19: implemented, needs testing.
			
			$sql = 'SELECT * FROM info_depot_comment ';
            $sql .= 'WHERE idc_idi_id = :id';

			$params = array(':id' => $item->getId());
            $results = $this->conn->query($sql, $params);
            if (!$results || \count($results) == 0) {
                return false;
            }

            return \array_map('self::ExtractInfoDepotItemFromRow', $results);
        } catch (\Exception $e) {
            $this->logError('Failed to get all items: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Adds a new comment for an item in the info depot database.
     * 
     * The item that the comment belongs to is specified via a reference to the InfoDepotItem in the InfoDepotComment
     * object itself.
     *
     * @param \Model\InfoDepotComment $comment the comment to add
     * @return boolean true if the execution succeeds, false otherwise
     */
    public function addNewInfoDepotComment($comment) {
		try {
				//4/26/19: implemented, needs testing
			
				//idc_id is generated using a secure cryptic ID generator found in 
				//./shared/classes/Util/IdGenerator.php.
				$sql = 'INSERT INTO info_depot_comment ';
				$sql .= '(idc_id, idc_u_id, idc_idi_id, idc_content, ';
				$sql .= 'idc_recommended, idc_date_created, idc_date_updated) ';
				$sql .= 'VALUES (:id, :userid, :itemid, :content, :rec, :datec, :dateu)';
				
				$params = array(
					':id' => $comment->getId(),
					':userid' => $comment->getUser()->getId(),
					':itemid' => $comment->getDepotItem()->getId(),
					':content' => $comment->getContent(),
					':recommended' => $comment->getRecommended(),
					':datec' => $comment->getDateCreated(),
					':dateu' => $comment->getDateUpdated()
				);
				$this->conn->execute($sql, $params);

				return true;
			} catch (\Exception $e) {
				$this->logError('Failed to add new comment: ' . $e->getMessage());

				return false;
        }
    }

    /**
     * Updates fields associated with an existing comment in the info depot database.
     *
     * @param \Model\InfoDepotComment $comment the comment to update
     * @return boolean true if the execution succeeds, false otherwise
     */
    public function updateInfoDepotComment($comment) {
		try {
				//4/26/19: implemented, needs testing
			
				//idc_id is generated using a secure cryptic ID generator found in 
				//./shared/classes/Util/IdGenerator.php.
				$sql = 'UPDATE info_depot_comment SET ';
				$sql .= 'idc_u_id = :userid, ';
				$sql .= 'idc_idi_id = :fname, ';
				$sql .= 'idc_content = :lname, ';
				$sql .= 'idc_recommended = :salu, ';
				$sql .= 'idc_date_updated = :email ';
				$sql .= 'WHERE idc_id = :id';

				$params = array(
					':id' => $comment->getId(),
					':userid' => $comment->getUser()->getId(),
					':content' => $comment->getContent(),
					':recommended' => $comment->getRecommended(),
					':dateu' => $comment->getDateUpdated()
				);
				$this->conn->execute($sql, $params);

				return true;
			} catch (\Exception $e) {
				$this->logError('Failed to update comment: ' . $e->getMessage());

				return false;
        }
    }

    /**
     * Creates a new InfoDepotComment object from the values in a row in the databse.
     * 
     * The InfoDepotComment will not have a user or info depot item associated with it. This is done intentionaly so
     * that there is no possibility of creating multiple copies of a single InfoDepotItem or User. Instead, to set
     * the references to the User and InfoDepotItem for the comment, do so after extracting the comment from
     * the row.
     *
     * @param mixed[]  $row
     * @return \Model\InfoDepotComment
     */
    public static function ExtractInfoDepotCommentFromRow($row) {
        return (new InfoDepotComment($row['idc_id']))
            ->setContent($row['idc_content'])
            ->setAsRecommended($row['idc_recommended'])
            ->setDateCreated(new \DateTime($row['idc_date_created']))
            ->setDateUpdated(new \DateTime($row['idc_date_updated']));
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
