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


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <title>Atmiya Parking</title><!-- styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css" rel=
    "stylesheet">
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
                              if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'yes') {
                                  echo "<li><a>Welcome, " . $_COOKIE['user'] . " </a></li>";
                              }
                              ?>

                    <li>
                        <a href="Home.php">Home</a>
                    </li>
                    <?php
                              ini_set('display_errors',0);
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
                        "button">Account <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <?php
                            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'yes') {
                                echo '<li><a href="loggedout.php">Logout</a></li>';
                            } else {
                                echo '<li><a href="login.php">Login</a></li><li><a href="signup.php">Sign up</a></li>';
                            }
                            ?>

                            
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
                    <!-- Department parking permit form -->
                    <br>


                    <form>
                    </form>


                    <form action="parkingpermits.php" method="get">
                        <input checked name="radio" type="radio" value=
                        "parkpermits"><label>Parking Permits[ID]</label>
                        <input name="radio" type="radio" value=
                        "health"><label>Health Violations</label> <input name=
                        "radio" type="radio" value=
                        "parkviolations"><label>Parking Violations</label><br>
                        <input name="query" placeholder="Permit ID" type=
                        "text"> <input type="submit" value="Search">
                    </form>
                    <?php
                    if (isset($_GET['query'])){
                    if ($_COOKIE['type'] == "admin" && isset($_GET['query']) == false) {
                        
                        
                        // changes characters used in html to their equivalents, for example: < to &gt;
                        $selected = $_GET['radio'];
                        if ($selected == "parkpermits") {
                            $raw_results      = $db->query("SELECT * FROM permits");
                            $raw_results_name = $db->query("SELECT name FROM users");
                            
                            
                            
                            // * means that it selects all fields, you can also write: `id`, `title`, `text`
                            // articles is the name of our table
                            
                            // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
                            // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
                            // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
                            
                            if ($raw_results->rowCount() > 0) { // if one or more rows are returned do following
                                echo "<table class='pure-table pure-table-horizontal'><tr>
                                            <td><h3>Permit ID</h3></td><td><h3>Name</h3></td><td><h3>Vehicle Type</h3></td><td><h3>Start Date</h3></td><td><h3>Expiry Date</h3></td>";
                                while ($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
                                    // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                                    
                                    $results_name = $raw_results_name->fetch(PDO::FETCH_ASSOC);
                                    
                                    echo "<tr>";
                                    echo "<td><p>" . $results['permit_id'] . "</td><td>" . $results_name['name'] . "</td><td>" . $results['vehicle_type'] . "</p></td><td>" . $results['start_date'] . "</td><td>" . $results['end_date'] . "</td>";
                                    echo "</tr>";
                                    // posts results gotten from database(title and text) you can also show id ($results['id'])
                                }
                                echo "</tr></table>";
                                
                            } else { // if there is no matching rows do following
                                echo "No results";
                            }
                        } else if ($selected == "health") {
                            $raw_results      = $db->query("SELECT * FROM has_violations");
                            $raw_results_name = $db->query("SELECT name FROM users");
                            
                            
                            // * means that it selects all fields, you can also write: `id`, `title`, `text`
                            // articles is the name of our table
                            
                            // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
                            // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
                            // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
                            
                            if ($raw_results->rowCount() > 0) { // if one or more rows are returned do following
                                echo "<table class='pure-table pure-table-horizontal'><tr>
                                            <td><h3>Violation ID</h3></td><td><h3>Name</h3></td><td><h3>Department ID</h3></td><td><h3>Time</h3></td><td><h3>Description</h3></td>";
                                while ($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
                                    // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                                    
                                    $results_name = $raw_results_name->fetch(PDO::FETCH_ASSOC);
                                    
                                    echo "<tr>";
                                    echo "<td>" . $results['violation_id'] . "</td><td>" . $results_name['name'] . "</td><td>" . $results['department_id'] . "</td><td>" . $results['time'] . "</td><td>" . $results['description'] . "</td>";
                                    echo "</tr>";
                                    // posts results gotten from database(title and text) you can also show id ($results['id'])
                                }
                                echo "</tr></table>";
                                
                            } else { // if there is no matching rows do following
                                echo "No results";
                            }
                        } else if ($selected == "parkviolations") {
                            $raw_results = $db->query("SELECT * FROM parking_citations");
                            
                            // * means that it selects all fields, you can also write: `id`, `title`, `text`
                            // articles is the name of our table
                            
                            // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
                            // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
                            // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
                            
                            if ($raw_results->rowCount() > 0) { // if one or more rows are returned do following
                                echo "<table class='pure-table pure-table-horizontal'><tr>
                                            <td><h3>Citation ID</h3></td><td><h3>Parmit ID</h3></td><td><h3>Registration</h3></td><td><h3>Vehicle Type</h3></td>";
                                while ($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
                                    // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                                    
                                    echo "<tr>";
                                    echo "<td>" . $results['citation_id'] . "</td><td>" . $results['permit_id'] . "</td><td>" . $results['rego'] . "</td><td>" . $results['vehicle_type'] . "</td>";
                                    echo "</tr>";
                                    // posts results gotten from database(title and text) you can also show id ($results['id'])
                                }
                                echo "</tr></table>";
                                
                            } else { // if there is no matching rows do following
                                echo "No results";
                            }
                        }
                    }











                    else if (isset($_GET['query'])) {
                        $query = $_GET['query'];
                        // gets value sent over search form
                        
                        
                        // you can set minimum length of the query if you want
                        
                        
                        // if query length is more or equal minimum length then
                            
                            
                            $query    = htmlspecialchars($query);
                            // changes characters used in html to their equivalents, for example: < to &gt;
                            $selected = $_GET['radio'];
                            if ($selected == "parkpermits") {
                                $raw_results      = $db->query("SELECT * FROM permits
                                WHERE (`permit_id` LIKE '%" . $query . "%')");
                                $raw_results_name = $db->query("SELECT name FROM users");
                                
                                $raw_results_users = $db->query("SELECT * FROM users WHERE ('name' LIKE '%" . $query . "%')");
                                
                                // * means that it selects all fields, you can also write: `id`, `title`, `text`
                                // articles is the name of our table
                                
                                // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
                                // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
                                // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
                                
                                if ($raw_results->rowCount() > 0) { // if one or more rows are returned do following
                                    echo "<table class='pure-table pure-table-horizontal'><tr>
                                            <td><h3>Permit ID</h3></td><td><h3>Name</h3></td><td><h3>Vehicle Type</h3></td><td><h3>Start Date</h3></td><td><h3>Expiry Date</h3></td>";
                                    while ($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
                                        // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                                        
                                        $results_name  = $raw_results_name->fetch(PDO::FETCH_ASSOC);
                                        $results_users = $raw_results_users->fetch(PDO::FETCH_ASSOC);
                                        echo "<tr>";
                                        echo "<td><p>" . $results['permit_id'] . "</td><td>" . $results_name['name'] . "</td><td>" . $results['vehicle_type'] . "</p></td><td>" . $results['start_date'] . "</td><td>" . $results['end_date'] . "</td>";
                                        echo "</tr>";
                                        // posts results gotten from database(title and text) you can also show id ($results['id'])
                                    }
                                    echo "</tr></table>";
                                    
                                } else { // if there is no matching rows do following
                                    echo "No results";
                                }
                            } else if ($selected == "health") {
                                $raw_results      = $db->query("SELECT * FROM has_violations
                                WHERE (`name` LIKE '%" . $query . "%')");
                                $raw_results_name = $db->query("SELECT name FROM users");
                                
                                $raw_results_users = $db->query("SELECT * FROM users WHERE ('name' LIKE '%" . $query . "%')");
                                
                                // * means that it selects all fields, you can also write: `id`, `title`, `text`
                                // articles is the name of our table
                                
                                // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
                                // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
                                // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
                                
                                if ($raw_results->rowCount() > 0) { // if one or more rows are returned do following
                                    echo "<table class='pure-table pure-table-horizontal'><tr>
                                            <td><h3>Violation ID</h3></td><td><h3>Name</h3></td><td><h3>Department ID</h3></td><td><h3>Time</h3></td><td><h3>Description</h3></td>";
                                    while ($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
                                        // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                                        
                                        $results_name  = $raw_results_name->fetch(PDO::FETCH_ASSOC);
                                        $results_users = $raw_results_users->fetch(PDO::FETCH_ASSOC);
                                        echo "<tr>";
                                        echo "<td>" . $results['violation_id'] . "</td><td>" . $results_name['name'] . "</td><td>" . $results['department_id'] . "</td><td>" . $results['time'] . "</td><td>" . $results['description'] . "</td>";
                                        echo "</tr>";
                                        // posts results gotten from database(title and text) you can also show id ($results['id'])
                                    }
                                    echo "</tr></table>";
                                    
                                } else { // if there is no matching rows do following
                                    echo "No results";
                                }
                            } else if ($selected == "parkviolations") {
                                $raw_results = $db->query("SELECT * FROM parking_citations
                                WHERE (`citation_id` LIKE '%" . $query . "%')");
                                
                                // * means that it selects all fields, you can also write: `id`, `title`, `text`
                                // articles is the name of our table
                                
                                // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
                                // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
                                // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
                                
                                if ($raw_results->rowCount() > 0) { // if one or more rows are returned do following
                                    echo "<table class='pure-table pure-table-horizontal'><tr>
                                            <td><h3>Citation ID</h3></td><td><h3>Parmit ID</h3></td><td><h3>Registration</h3></td><td><h3>Vehicle Type</h3></td>";
                                    while ($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
                                        // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                                        
                                        echo "<tr>";
                                        echo "<td>" . $results['citation_id'] . "</td><td>" . $results['permit_id'] . "</td><td>" . $results['rego'] . "</td><td>" . $results['vehicle_type'] . "</td>";
                                        echo "</tr>";
                                        // posts results gotten from database(title and text) you can also show id ($results['id'])
                                    }
                                    echo "</tr></table>";
                                    
                                } else { // if there is no matching rows do following
                                    echo "No results";
                                }
                            } 
                        
                    }
                    }

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