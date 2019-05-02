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
        <?php
        include_once PUBLIC_FILES . '/modules/header.php';
        ?>
    <!--
        <nav class="navbar fixed-top navbar-light bg-light">
            <a class="navbar-brand" href="#">InfoDepot</a>
        </nav>
	-->
        <br><br><br>

      
        <!-- Togglers for List / Grid View -->
        <span class="toggler active" data-toggle="grid"><span class="entypo-layout"></span></span>
        <span class="toggler" data-toggle="list"><span class="entypo-list"></span></span>

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
        


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <script type="text/javascript">

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
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
  </script>
</html>
