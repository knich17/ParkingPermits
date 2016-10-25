<?php
    $db = new PDO('mysql:host=localhost;dbname=parking_permits;charset=utf8mb4', 'root', '');
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
<!DOCTYPE html>
<!-- This webpage contains the form to allow users to apply for permits -->

<html lang="en">
<head>

    <script src="http://code.jquery.com/jquery-1.9.1.js">
    </script>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <title>Atmiya Parking</title><!-- styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-inverse col-lg-12">
        <div class="container-fluid">
            <div class="navbar-header">
                <button aria-expanded="false" class="navbar-toggle collapsed"
                data-target="#myInverseNavbar2" data-toggle="collapse" type=
                "button"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span> <span class="icon-bar"></span>
                <span class="icon-bar"></span></button> <a class="navbar-brand"
                href="Home.php">Atmiya College Parking</a>
            </div>
            <!-- Navigation section linking pages and login/logout buttons -->


            <div class="collapse navbar-collapse" id="myInverseNavbar2">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                            ini_set('display_errors',0);
                              if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'yes') {
                                echo "<li><a>Welcome, " . $_COOKIE['user'] . " </a></li>";
                              }
                              ?>

                    <li>
                        <a href="Home.php">Home</a>
                    </li>
                    <?php
                              if($_COOKIE['type'] == 'admin'){
                                echo '<li><a href="ParkingPermits.php">Search Database</a></li>';
                              }else{
                                echo '<li><a href="parkingpermitapplication.php">Parking Permit Application </a></li>';

                              }
                            ?>

                    <li>
                        <a href="Violations.php">Report Violation</a>
                    </li>


                    <li class="dropdown">
                        <a aria-expanded="false" aria-haspopup="true" class=
                        "dropdown-toggle" data-toggle="dropdown" href="#" role=
                        "button">Dropdown <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <?php
                                          if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'yes') {
                                            echo '<li><a href="loggedout.php">Logout</a></li>';
                                          } else {
                                            echo '<li><a href="login.php">Login</a></li><li><a href="signup.php">Sign up</a></li>';
                                          }
                                        ?>

                            <li>
                                <a href="#">Something else here</a>
                            </li>


                            <li class="divider" role="separator">
                            </li>


                            <li>
                                <a href="#">Separated link</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Photo carousel banner  -->
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-xs">
                <div class="carousel slide" id="carousel-299058">
                    <ol class="carousel-indicators">
                        <li class="" data-slide-to="0" data-target=
                        "#carousel-299058">
                        </li>


                        <li class="active" data-slide-to="1" data-target=
                        "#carousel-299058">
                        </li>
                    </ol>
                    <!-- Photos -->


                    <div class="carousel-inner">
                        <div class="item">
                            <img alt="thumb" class="img-responsive" src=
                            "../images/carpark.jpg">

                            <div class="carousel-caption">
                                Undercover parking with access to all building
                            </div>
                        </div>


                        <div class="item active">
                            <img alt="thumb" class="img-responsive" src=
                            "../images/camera.jpg">

                            <div class="carousel-caption">
                                Safe and secure with CCTV 24/7
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" data-slide="prev" href=
                    "#carousel-299058"><span class="icon-prev"></span></a>
                    <a class="right carousel-control" data-slide="next" href=
                    "#carousel-299058"><span class="icon-next"></span></a>
                </div>
            </div>
        </div>

        <hr>
    </div>

    <hr>
    <!-- Blank section for possible photo or other information to display on the webpage -->


    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="well">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    </div>
                    <?php
                                  if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'yes') {
                                    $user_id = $_COOKIE['user_id'];
                                    

                                    $sql = "SELECT * FROM permits WHERE user_id = '$user_id'"  ;
                                    $result = $db->query($sql);
                                    $permit_count = $result->rowCount();

                                    if($permit_count > 0){ // if one or more rows are returned do following

                                      echo "</br><h3 class='text-left'> You currently have " .$permit_count. " permit/s.</h3>";
                                      echo "<p align='centre'> View permits below or apply for another.</p>";
                                      echo "<table class='pure-table pure-table-horizontal'><tr>
                                                <td><h3>Vehicle Registration </h3></td><td><h3>Vehicle Type </h3></td><td><h3>End Date</h3></td>";
                                      while($results = $result->fetch(PDO::FETCH_ASSOC)){
                                      // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                                    
                                      
                                      echo "<tr>";
                                      echo "<p><td>".$results['vehicle_rego']."</td><td>".$results['vehicle_type']."</td><td>".$results['end_date']."</td></p>";
                                      echo "</tr>";
                                      // posts results gotten from database(title and text) you can also show id ($results['id'])
                                      }
                                      echo "</tr></table>";

                                      echo "</br></br>";

                                      if ($_COOKIE['type'] == "visitor"){
                                      echo"<h3 class='text-left'>Request another Parking Permit</h3>
                                      <form action='permit_app.php' method='post'>
                                        
                                        Lisence Plate:<br>
                                        
                                        <input type='text' name='plate' required>
                                        <br>

                                        <br>
                                        Vehicle Type:
                                        <br>
                                        
                                        <select name='vehicle_type' required>
                                          <option value=''>None</option>
                                          <option value='2 wheels'>2 Wheel</option>
                                          <option value='4 wheels'>4 Wheel</option>
                                          <option value='other'>Other</option>
                                        </select>
                                        <br>
                                        
                                        <br>
                                        Permit Start Date:
                                        <input type='date' name='date_time' min='2016-01-01' required>
                                        <br>
                                        
                                        <select required name='duration' hidden>
                                        <option value='days'>Days</option>
                                        </select>
                                        
                                        
                                        <select required name = 'lenght'>
                                        <option value=''>None</option>
                                          <option value='1'>1</option>
                                          <option value='2'>2</option>
                                          <option value='3'>3</option>
                                          <option value='4'>4</option>
                                          <option value='5'>5</option>
                                          <option value='6'>6</option>
                                          <option value='7'>7</option>
                                          
                                        </select>
                                        <br>
                                        <br>
                                        
                                        
                                        <input type='submit' value='Submit'>";
                                      }else if($_COOKIE['type'] == 'student'){
                                      echo"<h3 class='text-left'>Request another Parking Permit</h3>
                                      <form action='permit_app.php' method='post'>
                                        
                                        Lisence Plate:<br>
                                        
                                        <input type='text' name='plate' required><br>

                                        <br>
                                        Vehicle Type:
                                        <br>
                                        
                                        <select name='vehicle_type' required>
                                          <option value=''>None</option>
                                          <option value='2 wheels'>2 Wheel</option>
                                          <option value='4 wheels'>4 Wheel</option>
                                          <option value='other'>Other</option>
                                        </select>
                                        <br>
                                        <br>
                                        Permit Start Date:
                                        <br>
                                        <input type='date' name='date_time' min='2016-01-01' required>
                                        <br>
                                        <br>
                                        Duration:
                                        <br>
                                         <select required name='duration'>
                                        <option value=''>None</option>
                                          <option value='days'>Days</option>
                                          <option value='months'>Months</option>
                                          
                                          
                                        </select>
                                        
                                        <select required name = 'lenght'>
                                        <option value=''>None</option>
                                          <option value='1'>1</option>
                                          <option value='2'>2</option>
                                          <option value='3'>3</option>
                                          <option value='4'>4</option>
                                          <option value='5'>5</option>
                                          <option value='6'>6</option>
                                          <option value='7'>7</option>
                                          <option value='8'>8</option>
                                          <option value='9'>9</option>
                                          <option value='10'>10</option>
                                          <option value='11'>11</option>
                                          <option value='12'>12</option>
                                          <option value='13'>13</option>
                                          <option value='14'>14</option>
                                          <option value='15'>15</option>
                                          <option value='16'>16</option>
                                          
                                          
                                          
                                        </select>
                                        <br>
                                        <br>
                                        
                                        
                                        <input type='submit' value='Submit'>";

                                      }else if($_COOKIE['type'] == 'staff'){
                                      echo"<h3 class='text-left'>Request another Parking Permit</h3>
                                      <form action='permit_app.php' method='post'>
                                        
                                        Lisence Plate:
                                        <br>
                                        
                                        <input type='text' name='plate' required>
                                        <br>

                                        <br>
                                        Vehicle Type:
                                        <br>
                                        
                                        <select name='vehicle_type' required>
                                          <option value=''>None</option>
                                          <option value='2 wheels'>2 Wheel</option>
                                          <option value='4 wheels'>4 Wheel</option>
                                          <option value='other'>Other</option>
                                        </select><br>
                                        
                                        <br>
                                        Permit Start Date:
                                        <br>
                                        <input type='date' name='date_time' min='2016-01-01' required>
                                        <br><br>
                                        Duration:
                                        <br>
                                         <select required name='duration'>
                                        <option value=''>None</option>
                                          <option value='days'>Days</option>
                                          <option value='months'>Months</option>
                                          <option value='year'>Year</option>
                                          
                                        </select>

                                        <select required name = 'lenght'>
                                        <option value=''>None</option>
                                          <option value='1'>1</option>
                                          <option value='2'>2</option>
                                          <option value='3'>3</option>
                                          <option value='4'>4</option>
                                          <option value='5'>5</option>
                                          <option value='6'>6</option>
                                          <option value='7'>7</option>
                                          <option value='8'>8</option>
                                          <option value='9'>9</option>
                                          <option value='10'>10</option>
                                          <option value='11'>11</option>
                                        </select>
                                        <br>
                                        <br>
                                        
                                        
                                        <input type='submit' value='Submit'>";

                                      }



                                 
                                    }else{

                                      echo '</br> Welcome , you can apply for a permit using the form below.';

                                      if ($_COOKIE['type'] == "visitor"){
                                      echo"<h3 class='text-left'>Request a Parking Permit</h3>
                                      <form action='permit_app.php' method='post'>
                                        
                                        Lisence Plate:<br>
                                        
                                        <input type='text' name='plate' required>
                                        <br>

                                        <br>
                                        Vehicle Type:
                                        <br>
                                        
                                        <select name='vehicle_type' required>
                                          <option value=''>None</option>
                                          <option value='2 wheels'>2 Wheel</option>
                                          <option value='4 wheels'>4 Wheel</option>
                                          <option value='other'>Other</option>
                                        </select>
                                        <br>
                                        
                                        <br>
                                        Permit Start Date:
                                        <input type='date' name='date_time' min='2016-01-01' required>
                                        <br>
                                        
                                        <select required name='duration' hidden>
                                        <option value='days'>Days</option>
                                        </select>
                                        
                                        
                                        <select required name = 'lenght'>
                                        <option value=''>None</option>
                                          <option value='1'>1</option>
                                          <option value='2'>2</option>
                                          <option value='3'>3</option>
                                          <option value='4'>4</option>
                                          <option value='5'>5</option>
                                          <option value='6'>6</option>
                                          <option value='7'>7</option>
                                          
                                        </select>
                                        <br>
                                        <br>
                                        
                                        
                                        <input type='submit' value='Submit'>";
                                      }else if($_COOKIE['type'] == 'student'){
                                      echo"<h3 class='text-left'>Request a Parking Permit</h3>
                                      <form action='permit_app.php' method='post'>
                                        
                                        Lisence Plate:<br>
                                        
                                        <input type='text' name='plate' required><br>

                                        <br>
                                        Vehicle Type:
                                        <br>
                                        
                                        <select name='vehicle_type' required>
                                          <option value=''>None</option>
                                          <option value='2 wheels'>2 Wheel</option>
                                          <option value='4 wheels'>4 Wheel</option>
                                          <option value='other'>Other</option>
                                        </select>
                                        <br>
                                        <br>
                                        Permit Start Date:
                                        <br>
                                        <input type='date' name='date_time' min='2016-01-01' required>
                                        <br>
                                        <br>
                                        Duration:
                                        <br>
                                         <select required name='duration'>
                                        <option value=''>None</option>
                                          <option value='days'>Days</option>
                                          <option value='months'>Months</option>
                                          
                                          
                                        </select>
                                        
                                        <select required name = 'lenght'>
                                        <option value=''>None</option>
                                          <option value='1'>1</option>
                                          <option value='2'>2</option>
                                          <option value='3'>3</option>
                                          <option value='4'>4</option>
                                          <option value='5'>5</option>
                                          <option value='6'>6</option>
                                          <option value='7'>7</option>
                                          <option value='8'>8</option>
                                          <option value='9'>9</option>
                                          <option value='10'>10</option>
                                          <option value='11'>11</option>
                                          <option value='12'>12</option>
                                          <option value='13'>13</option>
                                          <option value='14'>14</option>
                                          <option value='15'>15</option>
                                          <option value='16'>16</option>
                                          
                                          
                                          
                                        </select>
                                        <br>
                                        <br>
                                        
                                        
                                        <input type='submit' value='Submit'>";

                                      }else if($_COOKIE['type'] == 'staff'){
                                      echo"<h3 class='text-left'>Request a Parking Permit</h3>
                                      <form action='permit_app.php' method='post'>
                                        
                                        Lisence Plate:
                                        <br>
                                        
                                        <input type='text' name='plate' required>
                                        <br>

                                        <br>
                                        Vehicle Type:
                                        <br>
                                        
                                        <select name='vehicle_type' required>
                                          <option value=''>None</option>
                                          <option value='2 wheels'>2 Wheel</option>
                                          <option value='4 wheels'>4 Wheel</option>
                                          <option value='other'>Other</option>
                                        </select><br>
                                        
                                        <br>
                                        Permit Start Date:
                                        <br>
                                        <input type='date' name='date_time' min='2016-01-01' required>
                                        <br><br>
                                        Duration:
                                        <br>
                                         <select required name='duration'>
                                        <option value=''>None</option>
                                          <option value='days'>Days</option>
                                          <option value='months'>Months</option>
                                          <option value='year'>Year</option>
                                          
                                        </select>

                                        <select required name = 'lenght'>
                                        <option value=''>None</option>
                                          <option value='1'>1</option>
                                          <option value='2'>2</option>
                                          <option value='3'>3</option>
                                          <option value='4'>4</option>
                                          <option value='5'>5</option>
                                          <option value='6'>6</option>
                                          <option value='7'>7</option>
                                          <option value='8'>8</option>
                                          <option value='9'>9</option>
                                          <option value='10'>10</option>
                                          <option value='11'>11</option>
                                        </select>
                                        <br>
                                        <br>
                                        
                                        
                                        <input type='submit' value='Submit'>";

                                      }


                                    }

                                  } else {
                                    echo '</br> Please sign in or sign up to apply for a parking permit.';
                                  }
                                  echo ''
                                ?>
                </div>


                <div class="row">
                </div>
            </div>
        </div>
    </div>

    <hr>


    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Location</h3>


                    <p><iframe allowfullscreen="" frameborder="0" height="450"
                    src=
                    "https://www.google.com/maps/embed/v1/place?q=Atmiya%20&key=AIzaSyBb2OkrRfTcJo6KHcc3vH2pVHORmSyrVME"
                    style="border:0" width="100%"></iframe>
                    </p>
                </div>


                <div class="col-lg-6">
                    <!-- Information about Atmiya services -->


                    <h3>Our Services</h3>

                    <hr>


                    <ul class="nav nav-tabs" id="myTab1">
                        <li class="active">
                            <a data-toggle="tab" href="#home1">Parking
                            Permits</a>
                        </li>


                        <li>
                            <a data-toggle="tab" href="#pane2">Health and
                            Safety</a>
                        </li>


                        <li>
                            <a data-toggle="tab" href="#pane3">Violations</a>
                        </li>
                    </ul>


                    <div class="tab-content" id="myTabContent1">
                        <div class="tab-pane fade in active" id="home1">
                            <p class="text-center"><img alt="" src=
                            "../images/permit.jpg">
                            </p>


                            <p>At Atmiya College, Permits for parking are
                            managed by our health and safety department.
                            Requesting a Permit can be done online or on campus
                            and are approved by one of our department
                            employees.</p>
                        </div>


                        <div class="tab-pane fade" id="pane2">
                            <p class="text-center"><img alt="" src=
                            "../images/safety_first.jpg">
                            </p>


                            <p>At Atmiya College, Health and Safety are managed
                            by our health and safety department. Submiting a
                            Health and safety report may help us better improve
                            the college environment</p>
                        </div>


                        <div class="tab-pane fade" id="pane3">
                            <p class="text-center"><img alt="" src=
                            "../images/violation.jpg">
                            </p>


                            <p>At Atmiya College, Voilations are managed by our
                            health and safety department. Submiting a voilation
                            report may help us discover and process voilation
                            more efficient</p>
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
    <script src="../js/jquery-1.11.3.min.js">
    </script> 
    <script src="../js/bootstrap.js">
    </script>
</body>
</html>