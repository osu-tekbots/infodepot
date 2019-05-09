<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/shared/css/browse.css">

    <!-- FontAwesome CSS --> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Browse Items</title>
  </head>
  <body>
        <!-- NAV BAR -->
        <?php
        include_once PUBLIC_FILES . '/modules/header.php';
        ?>
    <!--
        <nav class="navbar fixed-top navbar-light bg-light">
            <a class="navbar-brand" href="#">InfoDepot</a>
        </nav>
-->
        <br>
        <h4>Filtering</h4>
        <div class="filterOptions">
            <input class="form-control" id="filterInput" type="text" placeholder="Search...">

                    <div class="form-group">
                        <label for="courseFilterSelect">Course Filter</label>
                        <select class="form-control" id="courseFilterSelect" onchange="filterSelectChanged(this)">
                            <option></option>
                            <option>CS</option>
                            <option>ECE</option>
                            <option>General Knowledge</option>
                            <option>ECE 271</option>
                            <option>ECE 323</option>
                            <option>ECE 342</option>
                            <option>ECE 352</option>
                            <option>ECE 353</option>
                            <option>ECE 372</option>
                            <option>ECE 391</option>
                            <option>ECE 413</option>
                            <option>ECE 418</option>
                            <option>ECE 431</option>
                            <option>ECE 432</option>
                            <option>ECE 437</option>
                            <option>ECE 443</option>
                            <option>ECE 463</option>
                            <option>ECE 472</option>
                            <option>ECE 474</option>
                            <option>ECE 478</option>
                            <option>ECE 483</option>
                            <option>ECE 485</option>
                            <option>ECE 499</option>
                            <option>ECE 507</option>
                            <option>ECE 518</option>
                            <option>ECE 520</option>
                            <option>ECE 531</option>
                            <option>ECE 532</option>
                            <option>ECE 537</option>
                            <option>ECE 563</option>
                            <option>ECE 570</option>
                            <option>ECE 572</option>
                            <option>ECE 574</option>
                            <option>ECE 583</option>
                            <option>ECE 585</option>
                            <option>ECE 599</option>
                            <option>ECE 616</option>
                            <option>ECE 627</option>
                            <option>ECE 669</option>
                            <option></option>
                        </select>
                    </div>
            
                
            
                        <div class="sortingButton">
                        <!-- Title Sorting -->
                            <input type="radio" class="toggle toggle-left" id="sortTitleAscRadio" value="sortTitleAsc" name="sortRadio">
                            <label class="btn" for="sortTitleAscRadio">Title (A..Z)</label>
                            <input type="radio" class="toggle toggle-right" id="sortTitleDescRadio" value="sortTitleDesc" name="sortRadio">
                            <label class="btn" for="sortTitleDescRadio">Title (Z..A)</label>
                        </div>

                        <div class="sortingButton">
                         <!-- Date Sorting -->
                            <input type="radio" class="toggle toggle-left" id="sortDateDescRadio" value="sortDateDesc" name="sortRadio">
                            <label class="btn" for="sortDateDescRadio">Date (Recent)</label>
                            <input type="radio" class="toggle toggle-right" id="sortDateAscRadio" value="sortDateAsc" name="sortRadio">
                            <label class="btn" for="sortDateAscRadio">Date (Oldest)</label>
                        </div>

                        <div class="sortingButton">
                         <!-- Rating Sorting -->
                            <input type="radio" class="toggle toggle-left" id="sortRatingAscRadio" value="sortRatingAsc" name="sortRadio" >
                            <label class="btn" for="sortRatingAscRadio">Rating (Highest)</label>
                            <input type="radio" class="toggle toggle-right" id="sortRatingDescRadio" value="sortRatingDesc" name="sortRadio">
                            <label class="btn" for="sortRatingDescRadio">Rating (Lowest)</label>
                        </div>
                  

                        


    </div>
        <!-- Togglers for List / Grid View -->
        <span class="toggler active" data-toggle="grid"><span class="entypo-layout"></span></span>
        <span class="toggler" data-toggle="list"><span class="entypo-list"></span></span>
        <br>

      

        <ul class="infos grid" id="info-grid">

        <!-- SINGLE ITEM START -->
    <?php
        $dao = new DataAccess\InfoDepotItemsDao($dbConn);
/*
        $infoCourse = "Course Name";
        $infoTitle= "Info Title";
        $ratingnumber = 74;
        
        $lastUpdated = "04/25/19";
*/
        

        /* WORK THAT STILL NEEDS TO HAPPEN
        
        STILL NEED TO GRAB DATA FOR 
            KEYWORDS
            INFO CATEGORY
            NUMBER UPVOTES
            NUMBER DOWNVOTES
            AUTHOR

        STILL NEEDS TO BE DONE
            ENTIRE ITEM NEEDS TO BE A LINK TO CLICK
            FIX CSS IF TITLE TOO LARGE ETC.
            MATH FOR RATING NUMBER FROM UPVOTES/DOWNVOTES

        */

      
        function renderInfoDepotItems(){
            global $dao; 
            
            $items = $dao->getAllInfoDepotItems();
            
            $itemCount = 0;
            foreach($items as $item){

                    $keywords = "Keyword1, Keyword2, Keyword3, Keyword4, Keyword5";
                    $infocategory = "Hardware Specific";
                    $numberUpvoted = 15;
                    $numberDownvoted = 15;
                    $author = "Billy Bob Jeremy";

                    $infoTitle = $item->getTitle();
                    //echo 'Details: ' . $item->getDetails();
                    $lastUpdated = $item->getDateUpdated()->format('M d Y');
                    $infoCourse = $item->getCourse()->getCode();
                makeInfoItem($itemCount, $infoTitle, $infoCourse, $keywords, $lastUpdated, $author, $numberUpvoted, $numberDownvoted, $infocategory);
                $itemCount = $itemCount + 1;
            }
        }

        
        
        function makeInfoItem($itemCount, $infoTitle, $infoCourse, $keywords, $lastUpdated, $author, $numberUpvoted, $numberDownvoted, $infocategory){
            
            // Get rating number from number of upvotes and downvotes - 1 decimal place
            $ratingnumber = mt_rand(0, 100);

            echo('<li class="info-item" id="item'.$itemCount.'">');
            
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


            echo('<span class="info-author">
            Author: '.$author.'
            </span>');

            echo('<span class="info-lastupdated" id="lastUpdated'.$itemCount.'">
            Last Updated: '.$lastUpdated.'
            </span>');

            $sortRatingNumber = $ratingnumber;
            if (strlen($sortRatingNumber) == 1){
                $sortRatingNumber = '0'.$sortRatingNumber;
                $ratingnumber = "&nbsp;&nbsp;".$ratingnumber;
            }
            echo('<span style="display:none">Rating Number: '.$sortRatingNumber.'</span>');

            echo('<div class="pull-right">

            
            <span class="info-rating">
                <span class="info-rating-bg">
                ');
             //   <!-- Bar color (|CHANGE WIDTH BY STYLING | BACKGROUND COLOR RED)--> 
               
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: #8DC63F;"></span>

            
                </span>');
            //  <!-- Color for percentage (NEUTRAL % OF RATING UP)-->
                echo('<span class="info-rating-labels">
                
                  <span class="info-rating-label-'.$itemCount.'" style="color: #A1A1A4;">
                  <a data-toggle="tooltip" data-placement="bottom" title="'.$ratingnumber.'% of users found this item helpful">
                    '.$ratingnumber.'% 
                  </a>
                </span>');
                
            

            //    <!-- Location for thumb icons --> 
        /*    echo('
                <span class="info-thumbs">
                <a href="#" data-toggle="tooltip" data-placement="bottom" title="You can only rate an info item inside the page">
                    <i class="thumbs-up far fa-thumbs-up"></i>
                    <i class="thumbs-down far fa-thumbs-down"></i>
                </a>
                </span>
        */
   
            
            echo('</span>
                
            </span>');
            
            
            if ($infocategory == "Tip"){
                
                echo('
               
                <span class="info-category">
                    <a data-toggle="tooltip" data-placement="top" title="Type: '.$infocategory.'">
                    <span class="category tip active" style="background:#ffc83f;">Tip</span>
                    </a>
                    <span class="category walkthrough">Walkthrough</span>
                    <span class="category hardwarespecific">Hardware Specific</span>
                    <span class="category general">General</span>        
                </span>
                ');
            }
            else if ($infocategory == "Walkthrough"){
                echo('
                <span class="info-category">
                    <span class="category tip">Tip</span>
                    <a data-toggle="tooltip" data-placement="top" title="Type: '.$infocategory.'">
                    <span class="category walkthrough active" style="background:blue;">Walkthrough</span>
                    </a>
                    <span class="category hardwarespecific">Hardware Specific</span>
                    <span class="category general">General</span>        
                </span>
                ');
            }
            else if ($infocategory == "Hardware Specific"){
                echo('<span class="info-category">
                    <span class="category tip">Tip</span>
                    <span class="category walkthrough">Walkthrough</span>
                    <a data-toggle="tooltip" data-placement="top" title="Type: '.$infocategory.'">
                    <span class="category hardwarespecific active" style="background:green;">Hardware Specific</span>
                    </a>
                    <span class="category general">General</span>        
                </span>');
            }
            else {
                echo('<span class="info-category">
                <span class="category tip">Tip</span>
                <span class="category walkthrough">Walkthrough</span>
                <span class="category hardwarespecific">Hardware Specific</span>
                <a data-toggle="tooltip" data-placement="top" title="Type: '.$infocategory.'">
                <span class="category general active" style="background:black;">General</span>    
                </a>    
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
            renderInfoDepotItems();
        ?>

       <!-- PLACE ALL ITEMS WITHIN ul info-class grid -->
        </ul>  
        


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <script type="text/javascript">
  

/*********************************************************************************
* Function Name: strstr()
* Description: Mimics strstr() php function that searches for the first occurence
* of a string (needle) in another string (haystack).
*********************************************************************************/
function strstr(haystack, needle, bool) {
    var pos = 0;
    haystack += '';
    pos = haystack.toLowerCase().indexOf((needle + '').toLowerCase());
    if (pos == -1) {
        return false;
    } else {
        if (bool) {
            return haystack.substr(0, pos);
        } else {
            return haystack.slice(pos);
        }
    }
}


    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

        //As each letter is typed in filterInput, filtering of cards will occur.
        //For drop down lists, like filtering by key word, filterInput is programmically
        //filled and keydown behavior is explicitly called.
        $("#filterInput").keydown(function(){
        var value = $(this).val().toLowerCase();
            var numItems = document.getElementById("info-grid").getElementsByTagName("li").length;

        for(var i = 0; i < numItems; i++){
            if($("#item" + i).text().toLowerCase().indexOf(value) > -1){
                $("#item" + i).show();
            }
            else{
                $("#item" + i).hide();
            }
        }
        });

        
        $('input[name="sortRadio"]').change(function() {
		switch ($(this).val()) {
			case "sortTitleAsc":
                var mylist = $('#info-grid');
				var listitems = mylist.children('li').get();
				listitems.sort(function(a, b) {
				   return $(a).text().toUpperCase().localeCompare($(b).text().toUpperCase());
				});

				$.each(listitems, function(index, item) {
				   mylist.append(item);
				});
                break;
            case "sortTitleDesc":
                var mylist = $('#info-grid');
                var listitems = mylist.children('li').get();
                listitems.sort(function(a, b) {
                    return $(b).text().toUpperCase().localeCompare($(a).text().toUpperCase());
                });

                $.each(listitems, function(index, item) {
                    mylist.append(item);
                });
                break;
            case "sortDateAsc":
				var mylist = $('#info-grid');
                var listitems = mylist.children('li').get();
				listitems.sort(function(a, b) {
                    return strstr($(a).text(), "Last Updated:").toUpperCase().localeCompare(strstr($(b).text(), "Last Updated:").toUpperCase());
				});

				$.each(listitems, function(index, item) {
				   mylist.append(item);
				});
				break;
			case "sortDateDesc":
				var mylist = $('#info-grid');
				var listitems = mylist.children('li').get();
				listitems.sort(function(a, b) {
                    return strstr($(b).text(), "Last Updated:").toUpperCase().localeCompare(strstr($(a).text(), "Last Updated:").toUpperCase());
                });
                
				$.each(listitems, function(index, item) {
				   mylist.append(item);
				});
                break;
            case "sortRatingAsc":
                var mylist = $('#info-grid');
                var listitems = mylist.children('li').get();
                listitems.sort(function(a, b) {
                    return strstr($(b).text(), "Rating Number:").toUpperCase().localeCompare(strstr($(a).text(), "Rating Number:").toUpperCase());
                });
                
                $.each(listitems, function(index, item) {
                    mylist.append(item);
                });
                break;
            case "sortRatingDesc":
                var mylist = $('#info-grid');
                var listitems = mylist.children('li').get();
                listitems.sort(function(a, b) {
                    return strstr($(a).text(), "Rating Number:").toUpperCase().localeCompare(strstr($(b).text(), "Rating Number:").toUpperCase());
                });
                
                $.each(listitems, function(index, item) {
                    mylist.append(item);
                });
                break;
            }
        });
    });


    (function () {
  $(function () {
    return $('[data-toggle]').on('click', function () {
      var toggle;
      toggle = $(this).addClass('active').attr('data-toggle');
      $(this).siblings('[data-toggle]').removeClass('active');
      return $('.infos').removeClass('grid list').addClass(toggle);
    });
  });

}).call(this);

function filterSelectChanged(filterObject){
	var value = filterObject.value;
	$("#filterInput").val(value);

	//Manually trigger keydown to mimic keydown function feature.
	//Attempted to programmically toggleProjectCard, but ran into
	//logical bug 2/26/19.
    var e = jQuery.Event("keydown");
    e.which = 77;
    $("#filterInput").trigger(e);
}

  </script>
</html>
