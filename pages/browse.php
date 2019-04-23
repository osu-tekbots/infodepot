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
      
        <!-- Togglers for List / Grid View -->
        <span class="toggler active" data-toggle="grid"><span class="entypo-layout"></span></span>
        <span class="toggler" data-toggle="list"><span class="entypo-list"></span></span>

        <ul class="infos grid">
        <!-- SINGLE ITEM START -->
        <li class="info-item">
                <?php
                    $ratingnumber = 54;
                    $infocategory = "Hardware Specific";
                ?>
            
             <!-- Put Course Name Here for list disply - NEED TO ADD FOR GRID DISPLAY TOO -->
            <span class="info-courseName list-only">
            EE324
            </span>
            
            <!-- Put Title of Info Snippet -->
            <span class="info-name">
            Coding in an Arduino Uno
            </span>
            
            <!-- Put Course Name Here for grid display -->
            <span class="info-courseName grid-only">
            EE324 
            </span>

            <span class="info-keywords">
            Arduino, Coding, Arduino Uno, Command
            </span>

            
            <div class="pull-right">

            <!-- List of comma seperated keywords -->

            
            <span class="info-rating">
                <span class="info-rating-bg">
                <!-- Bar color -->
                <?php
                if ($ratingnumber > 65){
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: #8DC63F;"></span>');
                }
                else if ($ratingnumber > 40){
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: #ffc83f;"></span>');
                }
                else {
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: red;"></span>');
                }

                ?>
                </span>
                <!-- Color for percentage -->
                <span class="info-rating-labels">
                <?php
                if ($ratingnumber > 65){
                    echo('<span class="info-rating-label" style="color:  #8DC63F;">
                    '.$ratingnumber.'%
                    </span>');
                }
                else if ($ratingnumber > 40){
                    echo('<span class="info-rating-label" style="color: #ffc83f;">
                    '.$ratingnumber.'%
                    </span>');
                }
                else {
                    echo('<span class="info-rating-label" style="color: red;">
                    '.$ratingnumber.'%
                    </span>');
                }

                ?>

                <!-- Location for thumb icons -->
                <span class="info-thumbs">
                    <i class="thumbs-up far fa-thumbs-up"></i>
                    <i class="thumbs-down far fa-thumbs-down"></i>
                </span>
                </span>
            </span>
            

            <?php
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

            ?>
            </div>
        </li>
        <!-- SINGLE ITEM END -->

        <!-- SINGLE ITEM START -->
        <li class="info-item">
                <?php
                    $ratingnumber = 84;
                    $infocategory = "Tip";
                ?>
            
             <!-- Put Course Name Here for list disply - NEED TO ADD FOR GRID DISPLAY TOO -->
            <span class="info-courseName list-only">
            General Info
            </span>
            
            <!-- Put Title of Info Snippet -->
            <span class="info-name">
            Making your VS Code Worksplace Window Larger
            </span>
            
            <!-- Put Course Name Here for grid display -->
            <span class="info-courseName grid-only">
            General Info
            </span>

            <span class="info-keywords">
            VS Code, Window, Coding
            </span>

            
            <div class="pull-right">

            <!-- List of comma seperated keywords -->

            
            <span class="info-rating">
                <span class="info-rating-bg">
                <!-- Bar color -->
                <?php
                if ($ratingnumber > 65){
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: #8DC63F;"></span>');
                }
                else if ($ratingnumber > 40){
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: #ffc83f;"></span>');
                }
                else {
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: red;"></span>');
                }

                ?>
                </span>
                <!-- Color for percentage -->
                <span class="info-rating-labels">
                <?php
                if ($ratingnumber > 65){
                    echo('<span class="info-rating-label" style="color:  #8DC63F;">
                    '.$ratingnumber.'%
                    </span>');
                }
                else if ($ratingnumber > 40){
                    echo('<span class="info-rating-label" style="color: #ffc83f;">
                    '.$ratingnumber.'%
                    </span>');
                }
                else {
                    echo('<span class="info-rating-label" style="color: red;">
                    '.$ratingnumber.'%
                    </span>');
                }

                ?>

                <!-- Location for thumb icons -->
                <span class="info-thumbs">
                    <i class="thumbs-up far fa-thumbs-up"></i>
                    <i class="thumbs-down far fa-thumbs-down"></i>
                </span>
                </span>
            </span>
            

            <?php
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

            ?>
            </div>
        </li>
        <!-- SINGLE ITEM END -->
        
        <!-- SINGLE ITEM START -->
        <li class="info-item">
                <?php
                    $ratingnumber = 66;
                    $infocategory = "General";
                ?>
            
             <!-- Put Course Name Here for list disply - NEED TO ADD FOR GRID DISPLAY TOO -->
            <span class="info-courseName list-only">
            EE922
            </span>
            
            <!-- Put Title of Info Snippet -->
            <span class="info-name">
            When you chop off electrical wire - why electrons do not drop off?
            </span>
            
            <!-- Put Course Name Here for grid display -->
            <span class="info-courseName grid-only">
            EE324 
            </span>

            <span class="info-keywords">
            Electrons, Electrical, EE, Wires
            </span>

            
            <div class="pull-right">

            <!-- List of comma seperated keywords -->

            
            <span class="info-rating">
                <span class="info-rating-bg">
                <!-- Bar color -->
                <?php
                if ($ratingnumber > 65){
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: #8DC63F;"></span>');
                }
                else if ($ratingnumber > 40){
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: #ffc83f;"></span>');
                }
                else {
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: red;"></span>');
                }

                ?>
                </span>
                <!-- Color for percentage -->
                <span class="info-rating-labels">
                <?php
                if ($ratingnumber > 65){
                    echo('<span class="info-rating-label" style="color:  #8DC63F;">
                    '.$ratingnumber.'%
                    </span>');
                }
                else if ($ratingnumber > 40){
                    echo('<span class="info-rating-label" style="color: #ffc83f;">
                    '.$ratingnumber.'%
                    </span>');
                }
                else {
                    echo('<span class="info-rating-label" style="color: red;">
                    '.$ratingnumber.'%
                    </span>');
                }

                ?>

                <!-- Location for thumb icons -->
                <span class="info-thumbs">
                    <i class="thumbs-up far fa-thumbs-up"></i>
                    <i class="thumbs-down far fa-thumbs-down"></i>
                </span>
                </span>
            </span>
            

            <?php
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

            ?>
            </div>
        </li>
        <!-- SINGLE ITEM END -->

        <!-- SINGLE ITEM START -->
        <li class="info-item">
        <?php
            $ratingnumber = 32;
            $infocategory = "Walkthrough";
        ?>
    
             <!-- Put Course Name Here for list disply - NEED TO ADD FOR GRID DISPLAY TOO -->
            <span class="info-courseName list-only">
            CS290
            </span>
            
            <!-- Put Title of Info Snippet -->
            <span class="info-name">
            How to make a big box in php and name it bob
            </span>
            
            <!-- Put Course Name Here for grid display -->
            <span class="info-courseName grid-only">
            CS290
            </span>

            <span class="info-keywords">
            Website Development, PHP, Box
            </span>

            
            <div class="pull-right">

            <!-- List of comma seperated keywords -->

            
            <span class="info-rating">
                <span class="info-rating-bg">
                <!-- Bar color -->
                <?php
                if ($ratingnumber > 65){
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: #8DC63F;"></span>');
                }
                else if ($ratingnumber > 40){
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: #ffc83f;"></span>');
                }
                else {
                    echo('<span class="info-rating-fg" style="width: '.$ratingnumber.'%; background-color: red;"></span>');
                }

                ?>
                </span>
                <!-- Color for percentage -->
                <span class="info-rating-labels">
                <?php
                if ($ratingnumber > 65){
                    echo('<span class="info-rating-label" style="color:  #8DC63F;">
                    '.$ratingnumber.'%
                    </span>');
                }
                else if ($ratingnumber > 40){
                    echo('<span class="info-rating-label" style="color: #ffc83f;">
                    '.$ratingnumber.'%
                    </span>');
                }
                else {
                    echo('<span class="info-rating-label" style="color: red;">
                    '.$ratingnumber.'%
                    </span>');
                }

                ?>

                <!-- Location for thumb icons -->
                <span class="info-thumbs">
                    <i class="thumbs-up far fa-thumbs-up"></i>
                    <i class="thumbs-down far fa-thumbs-down"></i>
                </span>
                </span>
            </span>
            

            <?php
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

            ?>
            </div>
        </li>
        <!-- SINGLE ITEM END -->

        

        


     
       
        </ul>  
        


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <script type="text/javascript">
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
