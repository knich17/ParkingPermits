
<?php
$connect=mysqli_connect('localhost','root','','parking_permits');
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 


$vehicle_rego=$_POST['plate'];
$vehicle_type=$_POST['vehicle_type'];
$type=$_COOKIE['type'];


$date_given = $_POST["date_time"];
echo $date_given;
$duration = $_POST['duration'];
$lenght = $_POST['lenght'];

if($duration == 'days'){
$end_date=( new DateTime($date_given));
date_modify($end_date,"+".$lenght." days");
echo date_format($end_date,"Y-m-d");

}else if ($duration == 'months'){
$end_date=( new DateTime($date_given));
date_modify($end_date,"+".$lenght." month");
echo date_format($end_date,"Y-m-d");

}else if($duration == 'year'){
$end_date=( new DateTime($date_given));
date_modify($end_date,"+".$lenght." year");
echo date_format($end_date,"Y-m-d");

}
$start_date=date('y/m/d', strtotime($_POST['date_time']));
$end_date=$end_date->format("Y-m-d");
//$end_date = date('d/m/y', strtotime($_POST['start_date']));
$user_id = $_COOKIE['user_id'];



$sql = "INSERT INTO permits(vehicle_rego, vehicle_type, user_id, start_date, end_date) VALUES ('$vehicle_rego', '$vehicle_type', '$user_id', '$start_date', '$end_date')";
if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
    header('Location: parkingpermitapplication.php');
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}


$connect->close();
?>