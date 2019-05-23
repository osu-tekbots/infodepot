<?php
/**
 * This page handles client requests to modify or fetch item-related data. All requests made to this page should
 * be a POST request with a corresponding `action` field in the request body.
 */

use DataAccess\UsersDao;
use Api\Response;
use DataAccess\InfoDepotItemsDao;
use DataAccess\InfoDepotCommentsDao;
use Api\ItemsActionHandler;
use Email\ItemsMailer;

session_start();

$logger = new Util\Logger($configManager->getLogFilePath(), $configManager->getLogLevel());

// Setup our data access and handler classes
$itemsDao = new InfoDepotItemsDao($dbConn, $logger);
$commentsDao = new InfoDepotCommentsDao($dbConn, $logger);
$usersDao = new UsersDao($dbConn, $logger);
//$mailer = new ItemsMailer($configManager->getEmailFromAddress(), $configManager->getEmailSubjectTag());
$handler = new ItemsActionHandler($itemsDao, $usersDao, $commentsDao, $configManager, $logger);

//fixme: once userid is setup, use the authorization
$handler->handleRequest();

echo '{"test" : "test1"}';


/*
// Authorize the request
if (isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {
    // Handle the request
    $handler->handleRequest();
} else {
    $handler->respond(new Response(Response::UNAUTHORIZED, 'You do not have permission to access this resource'));
}*/
