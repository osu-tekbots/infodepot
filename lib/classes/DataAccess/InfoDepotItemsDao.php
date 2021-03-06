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
    public function __construct($connection, $logger = null, $echoOnError = false) {
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
        // TODO: implement this stub
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
        // TODO: implement this stub
    }

    /**
     * Add a new entry for an info depot item in the database.
     *
     * @param \Model\InfoDepotItem $item the item to add to the database
     * @return boolean true if the execution is successful, false otherwise
     */
    public function addNewInfoDepotItem($item) {
        // TODO: implement this stub
    }

    /**
     * Updates an existing entry for an info depot item in the database.
     *
     * @param \Model\InfoDepotItem $item the item to update in the database
     * @return boolean true if the execution succeeds, false otherwise
     */
    public function updateInfoDepotItem($item) {

    }

    /**
     * Records that an IndoDepotItem was voted as helpful by adding a new entry to the appropriate join table in
     * the database.
     *
     * @param string $userId the ID of the user who voted
     * @param string $itemId the ID of the item that was voted as helpful
     * @return boolean true if the execution succeeds, false otherwise
     */
    public function recordInfoDepotItemAsHelpful($userId, $itemId) {
        // TODO: implement this stub
    }

    /**
     * Records that an IndoDepotItem was voted as not helpful by adding a new entry to the appropriate join table in
     * the database.
     *
     * @param string $userId the ID of the user who voted
     * @param string $itemId the ID of the item that was voted as unhelpful
     * @return boolean true if the execution succeeds, false otherwise
     */
    public function recordInfoDepotItemAsUnhelpful($userId, $itemId) {
        // TODO: implement this stub
    }

    /**
     * Fetches all courses that can be associated with an info depot item in the database.
     *
     * @return \Model\InfoDepotCourse[]|boolean an array of courses if successful, false otherwise
     */
    public function getAllInfoDepotCourses() {
        // TODO: implement this stub
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
