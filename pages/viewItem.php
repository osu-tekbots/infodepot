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

// Get all the various enumerations from the database
$courses = $dao->getAllInfoDepotCourses();

//fixme: maybe need this 
//allowIf($authorizedToProceed, 'pages/index.php');

//include_once PUBLIC_FILES . '/modules/admin-review.php';

$title = 'Create Item';

include_once PUBLIC_FILES . '/modules/header.php';

// Set Tooltip Texts
$tooltipProjectTitleInput = '';

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
$pID = $_GET['id'];
$item = $dao->getInfoDepotItem($pID);
$infoTitle = $item->getTitle();
$infoDetails = $item->getDetails();
$lastUpdated = $item->getDateUpdated()->format('M d Y');
$infoCourse = $item->getCourse()->getCode();




?>


<!doctype html>
<html lang="en">
  <body>
		<form id="formItem">
		
		<!-- START SINGLE INFO VIEW -->
		<?php

				function attachedFile($fileName){
					$pdf = "pdf";
					$image = "image";
					$attachment = $pdf;
					echo('
					<a href="">
					<div class=fileAttachment>
					filename text <span class="fileIcon">'.strtoupper($attachment).'&nbsp;&nbsp;<i class="fas fa-file-'.$attachment.'"></i></span>
					</div>
					</a>
					');
				}

				// Generation of a single element
				$commentScore = mt_rand(0, 100);
				$commentAuthor = "Billy Hill Bobby";
				$commentDate = "12:04 PM, 13 May 2018";
				$commentText = "This is a comment and text within the comment";
				$commentCount = 0;
				$lastUpdatedDate = "12:34 PM, 13 May 2018";


				function generateComment($commentScore, $commentAuthor, $commentDate, $commentText, $commentCount, $lastUpdatedDate){
					// REMOVE 
					$commentScore = mt_rand(-50, 50);
					//
					echo('

					<article class="comment">
								<span class="comment-img">
									<button id="upButton-'.$commentCount.'" type="button" onclick="upVote(this.id)" class="vote upvoteBtn">
									
										<svg class="upArrow" viewBox="0 0 11.5 6.4" xml:space="preserve">
										<path d="M11.4,5.4L6,0C5.9-0.1,5.8-0.1,5.8-0.1c-0.1,0-0.2,0-0.2,0.1
									L0.1,5.4C0,5.6,0,5.7,0.1,5.9l0.4,0.4c0.1,0.1,0.3,0.1,0.4,0l4.8-4.8l4.8,4.8c0.1,0.1,0.3,0.1,0.4,0l0.4-0.4
									C11.5,5.7,11.5,5.6,11.4,5.4z"/>
										</svg>
										
									</button>
									<h1 class="scoreCounter" id="scoreCounter-'.$commentCount.'">'.$commentScore.'</h1>
									<button id="downButton-'.$commentCount.'" type="button" onclick="downVote(this.id)" class="vote downvoteBtn">
									
									<svg class="downArrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 11.5 6.4" xml:space="preserve">
										<path d="M0.1,0.9l5.4,5.4c0.1,0.1,0.1,0.1,0.2,0.1c0.1,0,0.2,0,0.2-0.1
									l5.4-5.4c0.1-0.1,0.1-0.3,0-0.4L11,0c-0.1-0.1-0.3-0.1-0.4,0L5.8,4.8L0.9,0C0.8-0.1,0.6-0.1,0.5,0L0.1,0.4C0,0.6,0,0.7,0.1,0.9z"/>
									</svg>
								</button>
                </span>
								
							<div class="comment-body">
								<div class="text">
									<p>'.$commentText.'</p>
								</div>
								<p class="attribution">by <a href="#non">'.$commentAuthor.'</a> at '.$commentDate.'</p><a class="editCommentBtn" href="#editComment">Edit</a><p class="lastUpdatedComment">Last Updated: '.$lastUpdatedDate.'</p>  
							</div>
						</article>
						
					');
				}

		?>

		<!-- Page Content -->
		<br>
	  <div class="container">

	    <div class="row">
	      <div class="col-md-8 mb-5">
	        <h2 id="titleHeader"><?php echo("$infoTitle"); ?></h2>
	        <hr>
	        <p class="infoText"><?php echo("$infoDetails"); ?></p>
					<h2>Artifacts</h2>
					 <hr>
					 <!-- Place for loop to generate files here with attachedFile(file);-->
				 	<?php attachedFile("scrub.php"); ?>
					<br>
					<a href="/pages/browse.php"><button class="btn primary">Back to Browse</button></a>
					<br><br>
					<h2>Comments</h2>
					 <hr>
					 <!-- COMMENT SECTION START -->
					<section id="commentSection" class="comments">
						<?php 
						generateComment($commentScore, $commentAuthor, $commentDate, $commentText, $commentCount, $lastUpdatedDate); 
						generateComment($commentScore, $commentAuthor, $commentDate, $commentText, 1, $lastUpdatedDate); 
						generateComment($commentScore, $commentAuthor, $commentDate, $commentText, 2, $lastUpdatedDate); 
						generateComment($commentScore, $commentAuthor, $commentDate, $commentText, 3, $lastUpdatedDate); 
						generateComment($commentScore, $commentAuthor, $commentDate, "I am nagging I am a typical online user that hates everything and talks down on everything wow look at my comment ", 4, $lastUpdatedDate); 
						
						
						?>
				
						<!-- INCLUDE ALL COMMENTS WITHIN COMMENTS /SECTION BELOW-->
					</section>​

					<div id="commentBox">
						<textarea maxlength="140" name="commentText" id="commentMessage" placeholder="Add your comment!"></textarea>
						<input type="button" value="Add Comment" onclick="commentSubmit()">
					</div>

				

<!-- COMMENT SECTION END -->

	      </div>

	      <div class="col-md-4 mb-5" >
	        <h2>Details</h2>
					<hr>
					<address>
						<strong>Relevant Course:</strong>
						<p><?php echo("$infoCourse"); ?></p>
					</address>
					<address>
						<strong>Type:</strong>
	          <p>Walkthrough</p>
	        </address>
					<address>
						<strong>Keywords:</strong>
						<p>		Keywords<?php
								?>
						</p>
					</address>
					<address>
						<strong>Author:</strong>
	          <p>Author</p>
					</address>
					<address>
						<strong>Last Updated:</strong>
	          <p><?php echo("$lastUpdated"); ?></p>
					</address>
					<address>
						<h6><strong>Did you find this info item helpful?</strong></h6>
						<button class="ratingBtn" id="helpfulBtn">Helpful</button><button class="ratingBtn" id="unhelpfulBtn">Not Helpful</button>
					</address>

	      </div>
	    </div>
			<br>


	 
			</form>
 </body>
	<script type="text/javascript">

	function commentSubmit() {
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

	
	 //START UPVOTE DOWNVOTE

function upVote(id) {
	var upvote = 1;
	var numberTag = id.substr(-1);
	var score = Number(document.getElementById("scoreCounter-"+ numberTag).innerHTML);
	score = score+1;
	document.getElementById("scoreCounter-"+ numberTag).innerHTML = score;
  checkScore(numberTag);
}

function downVote(id) {
	var downvote = -1;
	var numberTag = id.substr(-1);
	var score = Number(document.getElementById("scoreCounter-"+ numberTag).innerHTML);	
	score = score-1;
	document.getElementById("scoreCounter-"+ numberTag).innerHTML = score;
  checkScore(numberTag);
}

var x = document.getElementById("commentSection").childElementCount;
for (var i = 0; i < x; i++){
	checkScore(i);
}

function checkScore(numberTag) {
	var number = document.getElementById("scoreCounter-"+ numberTag).innerHTML;
	var score = document.getElementById("scoreCounter-"+ numberTag);
  if (number < 0) {
    score.style.color = "#FF586C";
  } else if (number > 0) {
    score.style.color = "#6CC576";
  } else {
    score.style.color = "#666666";
  }
}


	/**
	 * Serializes the form and returns a JSON object with the keys being the values of the `name` attribute.
	 * @returns {object}
	 */
	function getItemFormDataAsJson() {
		let form = document.getElementById('formItem');
		let data = new FormData(form);

		let json = {
			title: $('#titleHeader').val()
		};
		for (const [key, value] of data.entries()) {
			json[key] = value;
		}
		
		//alert(JSON.stringify(json));

		return json;
	}



	 // END UPVOTE DOWNVOTE
  
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
 

	// For Comment Box
	$(document).ready(function () {
    var comment = $('div#commentBox textarea'),
        counter = '',
        counterValue = 140, //change this to set the max character count
        minCommentLength = 10, //set minimum comment length
        $commentValue = comment.val(),
        $commentLength = $commentValue.length,
        submitButton = $('div#commentBox input[type=button]').hide();
  
    $('div#commentBox').prepend('<span class="counter"></span>').append('<p class="info">Min length: <span></span></p>');
    counter = $('span.counter');
    counter.html(counterValue); //display your set max length
    comment.attr('maxlength', counterValue); //apply max length to textarea
    $('div#commentBox').find('p.info > span').html(minCommentLength);
    // everytime a key is pressed inside the textarea, update counter
    comment.keyup(function () {
      var $this = $(this);
      $commentLength = $this.val().length; //get number of characters
      counter.html(counterValue - $commentLength); //update counter
      if ($commentLength > minCommentLength - 1) {
        submitButton.fadeIn(200);
      } else {
        submitButton.fadeOut(200);
      }
    });
  });

  </script>
</html>
