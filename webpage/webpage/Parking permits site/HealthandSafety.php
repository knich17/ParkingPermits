<!DOCTYPE html>

 <!-- This webpage contains the health and safety form to allow people to report any violations they witness -->
 <?php
    $db = new PDO('mysql:host=localhost;dbname=parking_permits;charset=utf8mb4', 'test', '');
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
         
        if connection fails it will stop loading the page and display an error
    */
    /* tutorial_search is the name of database we've created */
     
    session_start();
// if the user is logged in already, redirect them to the logged in homepage
     
?>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Atmiya Parking</title>

  <!-- styles -->
  <link rel="stylesheet" href="../css/bootstrap.css">


  </head>
  <body>
  <nav class="navbar navbar-inverse col-lg-12">
    <div class="container-fluid"> 
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myInverseNavbar2" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="Home.php">Atmiya College Parking</a> </div>
      
      <!-- Navigation section linking pages and login/logout buttons -->
      <div class="collapse navbar-collapse" id="myInverseNavbar2">
        <ul class="nav navbar-nav navbar-right">
        
        <?php
          if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'yes') {
            echo "Welcome, " . $_COOKIE['user'] . " ";
            echo '<a href="loggedout.php">Logout</a>';
          }
          ?>
          <li><a href="Home.php">Home</a></li>
          <?php
          if($_COOKIE['type'] == 'admin'){
            echo '<li><a href="ParkingPermits.php">Search Database</a></li>';
          }else{
            echo '<li><a href="parkingpermitapplication.php">Parking Permit Application </a></li>';

          }
        ?>
         
          <li><a href="HealthandSafety.php">Health & Safety Violations</a></li>
          
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php
              if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'yes') {
                echo '<a href="loggedout.php">Logout</a>';
              } else if (!isset($_SESSION['loggedIn']) && !$_SESSION['loggedIn'] == 'yes') {
                echo '<li><a href="login.php">Login</a></li><li><a href="signup.php">Sign up</a></li>';
              }
            ?>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <
    </div>

    <!-- Photo carousel banner  --> 
  </nav>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-xs">
          <div id="carousel-299058" class="carousel slide">
            <ol class="carousel-indicators">
              <li data-target="#carousel-299058" data-slide-to="0" class=""> </li>
              <li data-target="#carousel-299058" data-slide-to="1" class="active"> </li>
              
            </ol>
            <!-- Photos -->
            <div class="carousel-inner">
              <div class="item"> <img class="img-responsive" src="../images/carpark.jpg" alt="thumb">
                <div class="carousel-caption"> Undercover parking with access to all building </div>
              </div>
              <div class="item active"> <img class="img-responsive" src="../images/camera.jpg" alt="thumb">
                <div class="carousel-caption"> Safe and secure with CCTV 24/7 </div>
              </div>
             
            </div>
            <a class="left carousel-control" href="#carousel-299058" data-slide="prev"><span class="icon-prev"></span></a> <a class="right carousel-control" href="#carousel-299058" data-slide="next"><span class="icon-next"></span></a></div>
        </div>
      </div>
      <hr>
    </div>
  <hr>

  <!-- Blank section for possible photo or other information to display on the webpage -->
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-12">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6"> </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6"> </div>
        </div>
        <div class="row"> </div>
      </div>
      <div class="col-lg-3 col-md-6 col-md-offset-3 col-lg-offset-0">
        <div class="well">

  <!-- Health and safety form  -->

      <h3 class="text-center">Submit a Health and Safety Violation Report</h3>
        <form action="HealthandSafetySend.php" method="post">
        <p><br>
          
          Your name:<br>
          
          <input type="text" name="name" placeholder='Optional' ><br>
          
          </p>
          <p>
          Department:<br>

          <select name="department_id" >
            <option value="">Optional</option>
            <option value="1">IT</option>
            <option value="2">Business</option>
            <option value="3">drama</option>
            <option value="4">sport</option>
          </select>
         <br>
          
      </p>
      <p><br>
          
        Date and time violation occured:<br>
        <input type="datetime-local" name="date_time" min="2016-08-31" required>
        <br>
        <br>
        
        Description of violation:<br>
       <textarea name="description" cols="29" rows="5" required></textarea>
        <br>
          <br>
        <input type="submit" value="Submit">
    </div>
          </p>
        <hr>
    <div class="media-object-default"> </div>
      </div>
    </div>
  </div>
  <hr>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h3>Information</h3>
   
        <!-- Information about Atmiya services -->
        </div>
        <div class="col-lg-6">
          <h3>Our Services</h3>
          <hr>
          <ul id="myTab1" class="nav nav-tabs">
            <li class="active"> <a href="#home1" data-toggle="tab"> Parking Permits </a> </li>
            <li><a href="#pane2" data-toggle="tab">Health and Safety</a></li>
            <li> <a href="#pane3" data-toggle="tab">Violations</a> </li>
          </ul>
          <div id="myTabContent1" class="tab-content">
            <div class="tab-pane fade in active" id="home1">
              <p class="text-center"><img src="../images/permit.jpg" alt=""></p>
              <p>At Atmiya College, Permits for parking are managed by our health and safety department. Requesting a Permit can be done online or on campus and are approved by one of our
              department employees.</p>
            </div>
            <div class="tab-pane fade" id="pane2">
              <p class="text-center"><img src="../images/safety_first.jpg" alt=""></p>
              <p>At Atmiya College, Health and Safety are managed by our health and safety department. Submiting a Health and safety report may help us better improve the college environment </p>
            </div>
            <div class="tab-pane fade" id="pane3">
              <p class="text-center"><img src="../images/violation.jpg" alt=""></p>
              <p>At Atmiya College, Voilations are managed by our health and safety department. Submiting a voilation report may help us discover and process voilation more efficient</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <hr>
  <footer class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <p>Copyright © Atmiya College. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>
  <!-- jQuery --> 
  <script src="../js/jquery-1.11.3.min.js"></script> 
  <script src="../js/bootstrap.js"></script>
      
  </body>
</html>