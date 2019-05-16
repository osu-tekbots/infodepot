<?php
use DataAccess\InfoDepotItemsDao;
use DataAccess\KeywordsDao;
use Model\InfoDepotCourse;

if (!session_id()) {
    session_start();
}

// Make sure the user is logged in and allowed to be on this page
include PUBLIC_FILES . '/lib/shared/authorize.php';

//$isAdmin = $_SESSION['accessLevel'] == 'Admin';

//fixme: use for edit item
//$pId = $_GET['id'];
//$authorizedToProceed = $pId . '' != '' && $_SESSION['userID'] . '' != '';
//allowIf($authorizedToProceed, 'pages/index.php');

$dao = new InfoDepotItemsDao($dbConn, $logger);
$keywordsDao = new KeywordsDao($dbConn, $logger);

// Get all the various enumerations from the database
$courses = $dao->getAllInfoDepotCourses();

//fixme: maybe need this 
//allowIf($authorizedToProceed, 'pages/index.php');

//include_once PUBLIC_FILES . '/modules/admin-review.php';

$title = 'Create Item';

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


/*
 * FIXME: put code below into a separate create-item.js file. 
 * 
 *
 */
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

<script type="text/javascript">
$('#keywordsInput').on('change', function() {
    key = $('#keywordsInput').val();
    //Add user-generated keyword into the keywordsDiv.
    $('#keywordsDiv').append(
        '<span class="badge badge-light keywordBadge">' + key + ' <i class="fas fa-times-circle"></i></span>'
    );
    $('#keywordsInput').val('');
});

//Remove keywords when clicked.
$('body').on('click', '.keywordBadge', function(e) {
    this.remove();
});

$('#keywordsInput').autocomplete({
    source: availableTags
});

</script>

<script type="text/javascript">
var availableTags = [
<?php
	$availableKeywords = $keywordsDao->getAllKeywords();
	foreach ($availableKeywords as $k) {
		echo '"' . $k->getName() . '",';
	}
?>
];
</script>

<!doctype html>
<html lang="en">
  <body>
		<div class="container-fluid">
			<div class="col-sm-4">
				<!-- code for creating a new item below. -->
				<form id="formItem">
					<div class="form-group">
						<label for="titleInput">Title: <font size="2" style="color:red;">*required</font><br></label>
						<input class="form-control" id="titleInput" placeholder="Enter title here...">
					</div>
					<div class="form-group">
						<label for="detailsInput">Details: <font size="2" style="color:red;">*required</font><br></label>
						<textarea class="form-control" id="detailsInput" placeholder="Enter details here..." rows="3"></textarea>
					</div>
					<label for="courseSelect">Relevant Course: </label>
					<select class="form-control" id="courseSelect">
					  <?php generateCourses(); ?>
					</select>
					<br>
					<div class="form-group">
						<div class="ui-widget">
							<label for="keywordsInput">
								Add Up To 5 Keywords to Project: <font size="2" style="color:red;">*required</font><br>
								<font size="2">Press Enter after each keyword.</font>
							</label>
							<input id="keywordsInput" name="keywords" class="form-control">
						</div>
						<br>
						<div id="keywordsDiv">
						</div>
					</div>
					<br>
					Create Artifacts:
					<br>
					<div class="infos grid">
						<div class="info-item">
							<span class="info-keywords">Description</span>
							<span class="info-title">
								<input id="artifactNameInput" name="artifactname" class="form-control" placeholder="Artifact Name"></input>
							</span>
							<span class="info-keywords">Link</span>
							<span class="info-title">
								<input id="artifactLinkInput" name="artifactlink" class="form-control" placeholder="Artifact Link"></input>
							</span>
							<!-- fixme: talk about architecture for artifacts later. -->
					</div>

					<button type="button" id="createItemBtn" class="btn btn-outline-secondary">Submit</button>
					<br><br>
				</form>
				<!-- end of code for creating a new item. -->
			</div>
			<div class="col-sm-8">
				 <ul class="infos grid">

						<!-- SINGLE ITEM START -->
					<?php

						$infoCourse = "Course Name";
						$infoTitle= "Info Title";
						$keywords = "Keyword, Keyword, Keyword";
						$ratingnumber = 74;
						$infocategory = "Hardware Specific";
						$lastUpdated = "04/25/19";
						$numberUpvoted = 15;
						$numberDownvoted = 15;
						$author = "Billy Bob Jeremy";
						
						function makeInfoItem($infoTitle, $infoCourse, $keywords, $lastUpdated, $author, $numberUpvoted, $numberDownvoted, $infocategory){

							// Get rating number from number of upvotes and downvotes - 1 decimal place
							$ratingnumber = 50;

						echo('<li class="info-item">');
							
							// <!-- Put Course Name Here for list disply - NEED TO ADD FOR GRID DISPLAY TOO -->
							echo('<span class="info-courseName list-only">
							'.$infoCourse.'
							</span>');
							
							// <!-- Put Title of Info Snippet -->
							echo('<span class="info-title">
							'.$infoTitle.'
							</span>');
							
							// <!-- Put Course Name Here for grid display -->
							echo('<span class="info-courseName grid-only">
							'.$infoCourse.' 
							</span>');

							echo('<span class="info-keywords">
							'.$keywords.'
							</span>');

							echo('<span class="info-keywords">
							Last Updated: '.$lastUpdated.'
							</span>');

							echo('<span class="info-keywords">
							Author: '.$author.'
							</span>');

							
							echo('<div class="pull-right">

							
							<span class="info-rating">
								<span class="info-rating-bg">
								');
							 //   <!-- Bar color (|CHANGE WIDTH BY STYLING | BACKGROUND COLOR RED)--> 
							   
									echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: #8DC63F;"></span>

							
								</span>');
							//  <!-- Color for percentage (NEUTRAL % OF RATING UP)-->
								echo('<span class="info-rating-labels">
								
								  <span class="info-rating-label" style="color: #A1A1A4;">
									'.$ratingnumber.'% 
								</span>');
								
							

							//    <!-- Location for thumb icons -->
							echo('
								<span class="info-thumbs">
								<a href="#" data-toggle="tooltip" data-placement="bottom" title="You can only rate an info item inside the page">
									<i class="thumbs-up far fa-thumbs-up"></i>
									<i class="thumbs-down far fa-thumbs-down"></i>
								</a>
								</span>
							
							</span>
								
							</span>');
							
							
							if ($infocategory == "Tip"){
								echo('<span class="info-category">
									<span class="category tip active" style="background:#ffc83f;">Tip</span>
									<span class="category walkthrough">Walkthrough</span>
									<span class="category hardwarespecific">Hardware Specific</span>
									<span class="category general">General</span>        
								</span>');
							}
							else if ($infocategory == "Walkthrough"){
								echo('<span class="info-category">
									<span class="category tip">Tip</span>
									<span class="category walkthrough active" style="background:blue;">Walkthrough</span>
									<span class="category hardwarespecific">Hardware Specific</span>
									<span class="category general">General</span>        
								</span>');
							}
							else if ($infocategory == "Hardware Specific"){
								echo('<span class="info-category">
									<span class="category tip">Tip</span>
									<span class="category walkthrough">Walkthrough</span>
									<span class="category hardwarespecific active" style="background:green;">Hardware Specific</span>
									<span class="category general">General</span>        
								</span>');
							}
							else {
								echo('<span class="info-category">
								<span class="category tip">Tip</span>
								<span class="category walkthrough">Walkthrough</span>
								<span class="category hardwarespecific">Hardware Specific</span>
								<span class="category general active" style="background:black;">General</span>        
								</span>');
							}

						echo('
							</div>
						</li>
						');

					}
						?>
						<!-- SINGLE ITEM END -->

						<?php
							makeInfoItem($infoTitle, $infoCourse, $keywords, $lastUpdated, $author, $numberUpvoted, $numberDownvoted, $infocategory);
						?>

					   <!-- PLACE ALL ITEMS WITHIN ul info-class grid -->
						</ul>  
			</div>
			
			<div class="col-sm-4">
			</div>
		</div>

 </body>
  <script type="text/javascript">
  
	$('#keywordsInput').on('change', function() {
		key = $('#keywordsInput').val();
		//Add user-generated keyword into the keywordsDiv.
		$('#keywordsDiv').append(
			'<span class="badge badge-light keywordBadge">' + key + ' <i class="fas fa-times-circle"></i></span>'
		);
		$('#keywordsInput').val('');
	});

	//Remove keywords when clicked.
	$('body').on('click', '.keywordBadge', function(e) {
		this.remove();
	});

	/**
	 * Serializes the form and returns a JSON object with the keys being the values of the `name` attribute.
	 * @returns {object}
	 */
	function getItemFormDataAsJson() {
		let form = document.getElementById('formItem');
		let data = new FormData(form);

		let json = {
			title: $('#titleInput').val(),
			details: $('#detailsInput').val(),
			course: $('#courseSelect').val()
		};
		for (const [key, value] of data.entries()) {
			json[key] = value;
		}
		
		//alert(JSON.stringify(json));

		return json;
	}

	/**
	 * Handler for a user click on the 'Save Project Draft' button. It will use AJAX to save the project in the
	 * database. The project title must not be empty.
	 */
	function onCreateItemClick() {
		//fixme: confirmed, is working json
		let body = getItemFormDataAsJson();

		if (body.title == '') {
			return snackbar('Please provide an item title', 'error');
		}
		if (body.details == '') {
			return snackbar('Please provide details', 'error');
		}
		
		body.action = 'createItem';

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
	
	$('#createItemBtn').on('click', onCreateItemClick);
  </script>
</html>
