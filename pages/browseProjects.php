<?php

$dao = new DataAccess\InfoDepotItemsDao($dbConn);

function updateInfoDepotItem($item){
	global $dao;
	
	if($dao->updateInfoDepotItem($item)){
		return true;
	}
	
	return false;
}

function createNewInfoDepotItem($hello, $jack, $userid){
	global $dao; 
	
	$newitem = new Model\InfoDepotItem();
	$newitem->setTitle($hello);
	$newitem->setDetails($jack);
	$newitem->setDateCreated(DataAccess\QueryUtils::FormatDate(new DateTime()));
	$newitem->setDateUpdated(DataAccess\QueryUtils::FormatDate(new DateTime()));

	
	//fixme: hardcoded for development work, this is my user id.
	//this should be removed in future releases.
	$userid = 'NvTykUuoi7DlzDzH';
	
	$newuser = new Model\User();
	$newuser->setId($userid);
	
	//fixme: once the user login credentials are working, we need to only 
	//pass in the User object of the user signed in. From there, just assign 
	//that user object as the user property of $newitem.
	$newitem->setUser($newuser);

	//fimxe: get all the course stuff handled appropriately, should eventually 
	//just need to pass in the object that was chosen by the user. From there, 
	//you set the course of newitem.
	$newcourse = new Model\InfoDepotCourse('1', 'Intro to Computer Science', 'CS161');
	$newitem->setCourse($newcourse);

	
	//fixme: testing code.
	/*
	echo $newitem->getTitle();
	echo '<br>';
	echo $newitem->getDetails() . '<br>';
	echo $newitem->getUser()->getId() . '<br>';
	echo $newitem->getCourse()->getId() . ' ' . $newitem->getCourse()->getCode() . '<br>';
	echo $newitem->getDateCreated() . '<br>';
	echo $newitem->getDateUpdated() . '<br>';
	*/

	if($dao->addNewInfoDepotItem($newitem)){
		return true;
	}
	
	return false;
}

function renderInfoDepotItems(){
	global $dao; 
	
	$items = $dao->getAllInfoDepotItems();

	foreach($items as $item){
		echo '<div class="card">';
			echo 'Title: ' . $item->getTitle();
			echo '<br>';
			echo 'Details: ' . $item->getDetails();
			echo '<br>';
			echo 'Last Updated: ' . $item->getDateUpdated()->format('M d Y');
			echo '<br>';
			echo 'Course: ' . $item->getCourse()->getCode();
			echo ''; 
		echo '</div>';
		echo '<br>';
	}
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/shared/css/browse.css">
    <link rel="stylesheet" href="../assets/shared/css/navbarandbody.css">

    <!-- FontAwesome CSS --> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Browse Items</title>
  </head>
  <body>
        <!-- NAV BAR -->
        <nav class="navbar fixed-top navbar-light bg-light">
            <a class="navbar-brand" href="#">InfoDepot</a>
        </nav>
        <br><br><br>
		
		<div class="container-fluid">
			<div class="col-sm-3">
				<?php renderInfoDepotItems(); ?> 
			
			</div>
		</div>
		


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <script type="text/javascript">

  </script>
</html>
