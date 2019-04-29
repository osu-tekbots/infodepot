<?php
use DataAccess\InfoDepotItemsDao;
use Model\InfoDepotCourse;

if (!session_id()) {
    session_start();
}

// Make sure the user is logged in and allowed to be on this page
include PUBLIC_FILES . '/lib/shared/authorize.php';

$isAdmin = $_SESSION['accessLevel'] == 'Admin';

//fixme: use for edit item
//$pId = $_GET['id'];
//$authorizedToProceed = $pId . '' != '' && $_SESSION['userID'] . '' != '';
//allowIf($authorizedToProceed, 'pages/index.php');

$dao = new InfoDepotItemsDao($dbConn, $logger);

//fixme: use for edit
/*
// Get the project and store properly formatted values into local variables
$project = $dao->getCapstoneProject($pId);

if ($project) {
    $pTitle = $project->getTitle();
    $pMotivation = $project->getMotivation();
    $pDescription = $project->getDescription();
    $pObjectives = $project->getObjectives();
    $pDateStart = $project->getDateStart() != null ? $project->getDateStart()->format('m/d/Y') : '';
    $pDateEnd = $project->getDateEnd() != null ? $project->getDateEnd()->format('m/d/Y') : '';
    $pMinQual = $project->getMinQualifications();
    $pPreferredQual = $project->getPreferredQualifications();
    $pCompensationId = $project->getCompensation()->getId();
    $pAdditionalEmails = $project->getAdditionalEmails();
    $pCategoryId = $project->getCategory()->getId();
    $pCategoryName = $project->getCategory()->getName();
    $pTypeId = $project->getType()->getId();
    $pFocusId = $project->getFocus()->getId();
    $pCopId = $project->getCop()->getId();
    $pNdaIpId = $project->getNdaIp()->getId();
    $pWebsiteLink = $project->getWebsiteLink();
    $pImages = $project->getImages();
    $pVideoLink = $project->getVideoLink();
    $pIsHidden = $project->getIsHidden();
    $pComments = $project->getProposerComments();
    $pStatusId = $project->getStatus()->getId();
    $pStatusName = $project->getStatus()->getName();
}
*/

//fixme: use for edit
// If the user is not the creator of the project or an admin, redirect them to the home page (unauthorized)
//$authorizedToProceed = $project->getProposer()->getId() == $_SESSION['userID'] || $isAdmin;


// Get all the various enumerations from the database
$courses = $dao->getAllInfoDepotCourses();

//fixme: maybe need this 
//allowIf($authorizedToProceed, 'pages/index.php');

//include_once PUBLIC_FILES . '/modules/admin-review.php';

$title = 'Create Item';

//fixme: use for contingent js
/*
$js = array(
    array(
        'defer' => 'true',
        'src' => 'assets/js/edit-project.js'
    ),
    array(
        'defer' => 'true',
        'src' => 'assets/js/admin-review.js'
    ),
    array(
        'defer' => 'true',
        'src' => 'assets/js/upload-image.js'
    )
);
*/

include_once PUBLIC_FILES . '/modules/header.php';

// Set Tooltip Texts
$tooltipProjectTitleInput = '';


//fixme: remove in future releases, use this for testing
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

?>


<!doctype html>
<html lang="en">
  <body>
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
			</div>
		</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	-->	
 </body>
  <script type="text/javascript">
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
		
		snackbar(body.action, 'success');
		
		api.post('/items.php', body)
			.then(res => {
				alert("success");
				snackbar(res.message, 'success');
			})
			.catch(err => {
				alert("error");
				snackbar(err.message, 'error');
			});
		
	}
	
	$('#saveItemDraftBtn').on('click', onSaveItemDraftClick);
  </script>
</html>
