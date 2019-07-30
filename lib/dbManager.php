<?php

/*********************************************************************************
 * Function Name: dbConnect()
 * Input: Connect with the database.
 * Output: Returns a database object which can be manipulated to manipulate db data
 * *******************************************************************************/

 function dbConnect() {
     // Globals
     //global $host, $user, $password, $db_name;
     $mysqli = new mysqli($server, $user, $pass, $dbname, 5000);
     if ($mysqli->connect_errno){
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        die;
    }
    return $mysqli;
 }

 //////////////////////////////////////////////////////////////////////////////////
 //Visual Upvote Functions/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////


/*********************************************************************************
 * Function Name: checkItemVote($userID, $itemID)
 * Input: UserID and info itemID
 * Output: Returns true or false if user has voted helpful
 * *******************************************************************************/

 
function checkItemHelpfulVote($userID, $itemID){
    $mysqli = dbConnect();
    /*
    $query = "SELECT 1 FROM `info_depot_found_helpful` WHERE `idfh_u_id` = '$userID' AND `idfh_idi_id` = '$itemID'";
    if(defined('DEBUG')){
        echo $query;
    }
    
    $result = $mysqli->query($query);
    if ($result->num_rows > 0){
        return true;
    }
    else {
        return false;
    }
    */
    return true;
}

/*********************************************************************************
 * Function Name: checkItemUnhelpfulVote($userID, $itemID)
 * Input: UserID and info itemID
 * Output: Returns true or false if user has voted unhelpful
 * *******************************************************************************/

 
function checkItemUnhelpfulVote($userID, $itemID){
    $mysqli = dbConnect();
    $query = "SELECT 1 FROM `info_depot_found_unhelpful` WHERE `idfu_u_id` = $userID AND `idfu_idi_id` = $itemID ";
    if(defined('DEBUG')){
        echo $query;
    }
    $result = $mysqli->query($query);
    if ($result->num_rows > 0){
        return true;
    }
    else {
        return false;
    }
}











?>