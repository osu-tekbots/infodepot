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

$title = 'Edit Item';

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


function generateCourses(){
	global $dao; 
	
	$courses = $dao->getAllInfoDepotCourses();

	foreach($courses as $course){
		echo '<option value="' . $course->getId() . '">';
		echo $course->getCode() . ': ' . $course->getName();
		echo '</option>';
	}
	
}

?>


<!doctype html>
<html lang="en">
  <body>
		<div class="container-fluid">
		</div>

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
			//fixme: add fields here.
		};
		for (const [key, value] of data.entries()) {
			json[key] = value;
		}
	
		return json;
	}

	/**
	 * Handler for a user click on the 'Save Item Draft' button. It will use AJAX to save the item in the
	 * database. The project title must not be empty.
	 */
	function onSaveItemClick() {
		let body = getItemFormDataAsJson();

		if (body.title == '') {
			return snackbar('Please provide an item title', 'error');
		}
		if (body.details == '') {
			return snackbar('Please provide details', 'error');
		}
		//fixme: add more
		
		body.action = 'saveItem';

		api.post('/items.php', body)
			.then(res => {
				snackbar(res.message, 'success');
			})
			.catch(err => {
				snackbar(err.message, 'error');
			});
		
	}
	
	$('#saveItemBtn').on('click', onSaveItemClick);
  </script>
</html>
