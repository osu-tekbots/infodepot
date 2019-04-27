<?php

$dao = new DataAccess\InfoDepotItemsDao($dbConn);

function updateInfoDepotItem($item){
	global $dao;
	
	if($dao->updateInfoDepotItem($item)){
		return true;
	}
	
	return false;
}



function createNewInfoDepotItem($title, $details, $userid){
	global $dao; 
	
	$newitem = new Model\InfoDepotItem();
	$newitem->setTitle($title);
	$newitem->setDetails($details);
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

    <title>Testy Test</title>
  </head>
  <body>
        <!-- NAV BAR -->
        <nav class="navbar fixed-top navbar-light bg-light">
            <a class="navbar-brand" href="#">InfoDepot</a>
        </nav>
        <br><br><br>
		
		<div class="container-fluid">
			<div class="col-sm-4">
				<!-- code for creating a new item below. -->
				<form id="formItem">
					<div class="form-group">
						<label for="titleInput">Title:</label>
						<input class="form-control" id="titleInput" placeholder="Enter title here...">
					</div>
					<div class="form-group">
						<label for="detailsInput">Details:</label>
						<textarea class="form-control" id="detailsInput" placeholder="Enter details here..." rows="3"></textarea>
					</div>
					<select class="form-control" id="courseSelect">
					  <option>CS161 - Introduction to Computer Science</option>
					</select>
					<br>
					<button type="button" id="saveItemDraftBtn" class="btn btn-outline-secondary">Submit</button>
					<br><br>
				</form>
				<!-- end of code for creating a new item. -->
			</div>
			<div class="col-sm-8">
			</div>
			
			<div class="col-sm-4">
				<div class="card-grid">
				<?php renderInfoDepotItems(); ?> 
				</div>
			</div>
		</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <script type="text/javascript">
	$("#titleInput").change(function(){
	  //alert("The title has been changed.");
	});
	$("#detailsInput").change(function(){
	  //alert("The details have been changed.");
	});
	
	
	/**
	 * Serializes the form and returns a JSON object with the keys being the values of the `name` attribute.
	 * @returns {object}
	 */
	function getItemFormDataAsJson() {
		let form = document.getElementById('formItem');
		let data = new FormData(form);

		let json = {
			title: $('#titleInput').val()
		};
		for (const [key, value] of data.entries()) {
			json[key] = value;
		}

		return json;
	}

	/**
	 * Handler for a user click on the 'Save Project Draft' button. It will use AJAX to save the project in the
	 * database. The project title must not be empty.
	 */
	function onSaveItemDraftClick() {
		let body = getItemFormDataAsJson();

		if (body.title == '') {
			//return snackbar('Please provide an item title', 'error');
		}
		
		

		body.action = 'saveItem';
		
		alert(body.action);
		/*
		api.post('/items.php', body)
			.then(res => {
				snackbar(res.message, 'success');
			})
			.catch(err => {
				snackbar(err.message, 'error');
			});
		*/
	}
	
	$('#saveItemDraftBtn').on('click', onSaveItemDraftClick);
  </script>
</html>
