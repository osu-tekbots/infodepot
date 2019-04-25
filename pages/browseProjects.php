<?php
$dao = new DataAccess\InfoDepotItemsDao($dbConn);


/*
$newitem = new Model\InfoDepotItem();
$newitem->setTitle("Fresh Title");
$newitem->setDetails("New Details");
$newitem->setDateCreated(DataAccess\QueryUtils::FormatDate(new DateTime()));
$newitem->setDateUpdated(DataAccess\QueryUtils::FormatDate(new DateTime()));


$newuser = new Model\User();
$newuser->setId('NvTykUuoi7DlzDzH');
$newitem->setUser($newuser);

$newcourse = new Model\InfoDepotCourse('1', 'Intro to Computer Science', 'CS161');
$newitem->setCourse($newcourse);

echo $newitem->getTitle();
echo '<br>';
echo $newitem->getDetails() . '<br>';
echo $newitem->getUser()->getId() . '<br>';
echo $newitem->getCourse()->getId() . ' ' . $newitem->getCourse()->getCode() . '<br>';
echo $newitem->getDateCreated() . '<br>';
echo $newitem->getDateUpdated() . '<br>';

if($dao->addNewInfoDepotItem($newitem)){
	echo '<br><br>';
	echo 'Worked!';
	echo '<br><br>';
}
else{
	echo '<br><br>';
	echo 'Nada';
	echo '<br><br>';
}
*/

$items = $dao->getAllInfoDepotItems();

foreach($items as $item){
	echo 'Title: ' . $item->getTitle();
	echo '<br>';
	echo 'Details: ' . $item->getDetails();
	echo '<br>';
	echo 'Last Updated: ' . $item->getDateUpdated()->format('M d Y');
	echo '<br>';
	echo 'Course: ' . $item->getCourse()->getCode();
	echo '<br><br><br>'; 
}

//echo '<br><br><br>';
//print_r($items);



?>