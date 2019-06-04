<?php
namespace DataAccess;

use Model\InfoDepotItem;
use Model\InfoDepotCourse;
use Model\InfoDepotComment;

/**
 * Houses the logic for database interactions relating to models in the OSU info depot system.
 */
class InfoDepotItemsDao {

    /** @var DatabaseConnection */
    private $conn;

    /** @var \Util\Logger */
    private $logger;

    /** @var boolean */
    private $echoOnError;

    /**
     * Constructs a new instance of the data access object for items in the info depot.
     *
     * @param DatabaseConnection $connection the connection to the database
     * @param \Util\Logger $logger logger used to log messages and errors
     * @param boolean $echoOnError flag to determine whether to echo error messages to the output buffer
     */
    public function __construct($connection, $logger = null, $echoOnError = true) {
        $this->conn = $connection;
        $this->logger = $logger;
        $this->echoOnError = $echoOnError;
    }

    /**
     * Fetches all info depot items.
     *
     * @param integer $offset the offset index in the table to start fetching items from. Defaults to 0.
     * @param integer $limit the limit to put on the number of items to fetch. A value of -1 will put no limit on
     * the return value. Defaults to -1.
     * @return \Model\InfoDepotItem[]|boolean an array of items if successful, false otherwise
     */
    public function getAllInfoDepotItems($offset = 0, $limit = -1) {
        try {
			//fixme: future implementation required: after comments 
			//and artificats are implemented, add support for them here
			//and all other select queries.
			
			$sql = 'SELECT info_depot_item.*, info_depot_course.* FROM info_depot_item, info_depot_course ';
            $sql .= 'WHERE idcr_id = idi_idcr_id';
			//$sql .= 'LIMIT :limit OFFSET :offset';
			
			$params = array(':offset' => $offset,
							':limit' => $limit);
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
     * Fetches all info depot items that are tagged with the provided list of keywords
     *
     * @param string[] $keywords
     * @param integer $offset the offset index in the table to start fetching items from. Defaults to 0.
     * @param integer $limit the limit to put on the number of items to fetch. A value of -1 will put no limit on
     * the return value. Defaults to -1.
     * @return \Model\InfoDepotItem[]|boolean an array of items if successful, false otherwise
     */
    public function getAllInfoDepotItemsWithKeywords($keywords, $offset = 0, $limit = -1) {
        // TODO: implement this stub
    }

    /**
     * Fetches all info depot items that are associated with the provided course
     *
     * @param InfoDepotCourse[] $course the course at OSU used to search for associated items
     * @param integer $offset the offset index in the table to start fetching items from. Defaults to 0.
     * @param integer $limit the limit to put on the number of items to fetch. A value of -1 will put no limit on
     * the return value. Defaults to -1.
     * @return \Model\InfoDepotItem[]|boolean an array of items if successful, false otherwise
     */
    public function getAllInfoDepotItemsForCourse($course, $offset = 0, $limit = -1) {
        // TODO: implement this stub
    }

    /**
     * Fetch a single info depot item with the provided ID.
     *
     * @param string $id the ID of the item to fetch
     * @return \Model\InfoDepotItem|boolean the associated info depot item if successful, false otherwise
     */
    public function getInfoDepotItem($id) {
        try {
			//fixme: future implementation required: after comments 
			//and artificats are implemented, add support for them here
			//and all other select queries.
			
			$sql = 'SELECT info_depot_item.*, info_depot_course.* FROM info_depot_item, info_depot_course ';
            $sql .= 'WHERE idi_id = :id';
			//$sql .= 'LIMIT :limit OFFSET :offset';
			
			$params = array(':id' => $id);
            $results = $this->conn->query($sql, $params);
            if (!$results || \count($results) == 0) {
                return false;
            }

            return (self::ExtractInfoDepotItemFromRow($results[0], true));
        } catch (\Exception $e) {
            $this->logError('Failed to get all items: ' . $e->getMessage());
            return false;
        }
    }



    /**
     * Add a new entry for an info depot item in the database.
     *
     * @param \Model\InfoDepotItem $item the item to add to the database
     * @return boolean true if the execution is successful, false otherwise
     */
    public function addNewInfoDepotItem($item) {
		try {
				//4/25/19: tested, working.
			
				//idi_id is generated using a secure cryptic ID generator found in 
				//./shared/classes/Util/IdGenerator.php.
				$sql = 'INSERT INTO info_depot_item ';
				$sql .= '(idi_id, idi_u_id, idi_title, idi_details, idi_idcr_id, ';
				$sql .= 'idi_date_created, idi_date_updated) ';
				$sql .= 'VALUES (:id,:userid, :title, :details, :courseid, :datec, :dateu)';
				
				$params = array(
					':id' => $item->getId(),
					':userid' => $item->getUser()->getId(),
					':title' => $item->getTitle(),
					':details' => $item->getDetails(),
					':courseid' => $item->getCourse()->getId(),
					':datec' => $item->getDateCreated(),
					':dateu' => $item->getDateUpdated()
				);
				$this->conn->execute($sql, $params);

				return true;
			} catch (\Exception $e) {
				$this->logError('Failed to add new item: ' . $e->getMessage());

				return false;
        }
    }


      /**
     * Add a new entry for an upvote of an info depot item in the database.
     *
     * @param \Model\InfoDepotItem $user_id the user ID to add to the database and $item_id the item ID to add to the database
     * @return boolean true if the execution is successful, false otherwise
     */
    public function upvoteInfoDepotItem($user_id, $item_id) {
		try {
				//6/03/19: Implemented, needs testing.
			
				//idi_id is generated using a secure cryptic ID generator found in 
				//./shared/classes/Util/IdGenerator.php.
				$sql = 'INSERT INTO info_depot_found_helpful ';
				$sql .= '(idfh_u_id, idfh_idi_id)';
				$sql .= 'VALUES (:user_id, :item_id)';
				
				$params = array(
					':user_id' => $user_id,
					':item_id' => $item_id
				);
				$this->conn->execute($sql, $params);

				return true;
			} catch (\Exception $e) {
				$this->logError('Failed to upvote item: ' . $e->getMessage());

				return false;
        }
    }

         /**
     * Add a new entry for an downvote of an info depot item in the database.
     *
     * @param \Model\InfoDepotItem $user_id the user ID to add to the database and $item_id the item ID to add to the database
     * @return boolean true if the execution is successful, false otherwise
     */
    public function downvoteInfoDepotItem($user_id, $item_id) {
		try {
				//6/03/19: Implemented, needs testing.
			
				//idi_id is generated using a secure cryptic ID generator found in 
				//./shared/classes/Util/IdGenerator.php.
				$sql = 'INSERT INTO info_depot_found_unhelpful ';
				$sql .= '(idfu_u_id, idfu_idi_id)';
				$sql .= 'VALUES (:user_id, :item_id)';
				
				$params = array(
					':user_id' => $user_id,
					':item_id' => $item_id
				);
				$this->conn->execute($sql, $params);

				return true;
			} catch (\Exception $e) {
				$this->logError('Failed to downvote item: ' . $e->getMessage());

				return false;
        }
    }

    /**
     * Fetches all upvotes that can be associated with an info depot item in the database.
     *
     * @return $results['count'] of upvotes if successful, false otherwise
     */
    public function getAllInfoDepotItemUpvotes($item_id) {
		try {
			//6/03/19: Implemented, needs testing.
			
			$sql = 'SELECT COUNT(*) AS "count" FROM info_depot_found_helpful WHERE idfh_idi_id = :item_id';

            $params = array(
                ':item_id' => $item_id
            );

            $results = $this->conn->query($sql, $params);
            if (!$results || \count($results) == 0) {
                return false;
            }

            return $results[0]['count'];
        } catch (\Exception $e) {
            $this->logError('Failed to get upvote count: ' . $e->getMessage());
            return false;
        }
    }

        /**
     * Fetches all upvotes that can be associated with an info depot item in the database.
     *
     * @return $results['count'] of upvotes if successful, false otherwise
     */
    public function getAllInfoDepotItemDownvotes($item_id) {
		try {
			//6/03/19: Implemented, needs testing.
			
            $sql = 'SELECT COUNT(*) AS "count" FROM info_depot_found_unhelpful WHERE idfu_idi_id = :item_id';
            

            $params = array(
                ':item_id' => $item_id
            );

            $results = $this->conn->query($sql, $params);
            if (!$results || \count($results) == 0) {
                return false;
            }

            return $results[0]['count'];
        } catch (\Exception $e) {
            $this->logError('Failed to get downvote count: ' . $e->getMessage());
            return false;
        }
    }




    /**
     * Updates an existing entry for an info depot item in the database.
     *
     * @param \Model\InfoDepotItem $item the item to update in the database
     * @return boolean true if the execution succeeds, false otherwise
     */
    public function updateInfoDepotItem($item) {
		try {
				//Set the date updated time to the current time.
				$item->setDateUpdated(DataAccess\QueryUtils::FormatDate(new DateTime()));
		
				//4/26/19: implemented, needs testing.
				$sql = 'UPDATE user SET ';
				$sql .= 'idi_u_id = :userid, ';
				$sql .= 'idi_title = :title, ';
				$sql .= 'idi_details = :details, ';
				$sql .= 'idi_idcr_id = :courseid, ';
				$sql .= 'idi_date_updated = :dateu ';
				$sql .= 'WHERE idi_id = :id';

				$params = array(
					':id' => $item->getId(),
					':userid' => $item->getUser()->getId(),
					':title' => $item->getTitle(),
					':details' => $item->getDetails(),
					':courseid' => $item->getCourse()->getId(),
					':datec' => $item->getDateCreated(),
					':dateu' => $item->getDateUpdated()
				);
				$this->conn->execute($sql, $params);

				return true;
			} catch (\Exception $e) {
				$this->logError('Failed to update item: ' . $e->getMessage());

				return false;
        }
    }

    /**
     * Records that an IndoDepotItem was voted as the passed in value by adding a new entry to the appropriate join table in
     * the database.
     *
	 * @param [FIXME] $value the value of the vote casted.
     * @param string $userId the ID of the user who voted
     * @param string $itemId the ID of the item that was voted as helpful
     * @return boolean true if the execution succeeds, false otherwise
     */
    public function recordInfoDepotItemAsValue($value, $userId, $itemId) {
		try {
				//4/26/19: implemented, needs testing.
			
				$sql = 'INSERT INTO info_depot_rating ';
				$sql .= '(idr_u_id, idr_idi_id, idr_value) ';
				$sql .= 'VALUES (:userid, :itemid, :value)';
				
				$params = array(
					':userid' => $userId, 
					':itemid' => $itemId,
					':value' => $value
				);
				$this->conn->execute($sql, $params);

				return true;
			} catch (\Exception $e) {
				$this->logError('Failed to record new value: ' . $e->getMessage());

				return false;
        }
    }

    /**
     * Fetches all courses that can be associated with an info depot item in the database.
     *
     * @return \Model\InfoDepotCourse[]|boolean an array of courses if successful, false otherwise
     */
    public function getAllInfoDepotCourses() {
		try {
			//4/26/19: Implemented, needs testing.
			
			$sql = 'SELECT info_depot_course.* FROM info_depot_course ORDER BY idcr_code';

            $results = $this->conn->query($sql);
            if (!$results || \count($results) == 0) {
                return false;
            }

            return \array_map('self::ExtractInfoDepotCourseFromRow', $results);
        } catch (\Exception $e) {
            $this->logError('Failed to get all courses: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Creates a new InfoDepotItem object from the values of a row in the database.
     *
     * @param mixed[] $row the row in the database to extract the values from
     * @return \Model\InfoDepotItem
     */
    public static function ExtractInfoDepotItemFromRow($row) {
        return (new InfoDepotItem($row['idi_id']))
            ->setUser(UsersDao::ExtractUserFromRow($row))
            ->setTitle($row['idi_title'])
            ->setDetails($row['idi_details'])
            ->setCourse(self::ExtractInfoDepotCourseFromRow($row, true))
            ->setDateCreated(new \DateTime($row['idi_date_created']))
            ->setDateUpdated(new \DateTime($row['idi_date_updated']));
    }

    /**
     * Creates a new InfoDepotCourse object from the values in a row in the database.
     *
     * The function takes a second argument that determines whether to use column holding the ID from the table
     * holding info depot item information or from the table holding course information.
     * 
     * @param mixed[] $row the row in the database to extract the values from
     * @param boolean $itemInRow flag to determine which column name to use to fetch the ID of the course 
     * @return \Model\InfoDepotCourse
     */
    public static function ExtractInfoDepotCourseFromRow($row, $itemInRow = false) {
        $id = $itemInRow ? 'idi_idcr_id' : 'idcr_id';
        return new InfoDepotCourse($row[$id], $row['idcr_name'], $row['idcr_code']);
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
