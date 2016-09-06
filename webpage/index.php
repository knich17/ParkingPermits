<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Parking Permits</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  
  <h1>
    Parking Permits
  </h1>
</head>

<body>
  <nav class="sidemenu" style="z-index:3;width:250px;margin-top:51px;" id ="sidemenu">
  <h4><b>Menu</b></h4>
  <a href="#" >Link</a><br>
  <a href="#" >Link</a><br>
  <a href="#" >Link</a><br>
  <a href="#" >Link</a><br>
  </nav>
   
  <div class="mainform">

  <form action="database.php" method="post">
    Department Requesting:<br>
    
    <select name="department_id" required >
      <option value="">None</option>
      <option value="1">IT</option>
      <option value="2">Business</option>
      <option value="3">drama</option>
      <option value="4">sport</option>
    </select><br>
    
    First name:<br>
    
    <input type="text" name="firstname" required><br>
    
    Last name:<br>
    
    <input type="text" name="lastname" required><br>
    
    Lisence Plate:<br>
    
    <input type="text" name="plate" required><br>

    Email:<br>
    <input type="email" name="email" required><br>
    
    Who are you:<br>
    
    <select name="user_type" required>
    <option value="">None</option>
      <option value="user">Student</option>
      <option value="admin">Staff</option>
      <option value="user">Visitor</option>
    </select><br>
    Vehicle Type:<br>
    
    <select name="vehicle_type" required>
      <option value="">None</option>
      <option value="2 wheels">2 Wheel</option>
      <option value="4 wheels">4 Wheel</option>
      <option value="other">Other</option>
    </select><br>
    
    Entry Date:
    <input type="date" name="start_date" min="2016-08-31" required><br>
    Duration:
    <select required>
    <option value="">None</option>
      <option value="days">Days</option>
      <option value="weeks">Weeks</option>
      <option value="months">Months</option>
      <option value="year">Year</option>
      
    </select>
    <select required>
    <option value="">None</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
    </select><br>
    <br>
    
    
    <input type="submit" value="Submit">
  </form>
  </div>
</body>

</html>