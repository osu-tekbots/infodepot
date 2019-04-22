hello
good-bye

<?php
$dao = new DataAccess\UsersDao($dbConn);
$types = $dao->getUserTypes();
foreach ($types as $type) {
    echo $type->getId() . ' - ' . $type->getName() . ' ';
}

?>