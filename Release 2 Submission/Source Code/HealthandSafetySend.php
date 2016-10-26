<?php
$connect=mysqli_connect('localhost','root','qwerty','parking_permits');
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 

$name=$_POST['name'] ?: 'NULL';

$department_id=$_POST['department_id'] ?: 'NULL';

$date_time=date('Y-m-d H:i:s', strtotime($_POST['date_time']));

$description = $_POST['description'];

$sql = "INSERT INTO has_violations(name, department_id, time, description) VALUES ('$name',$department_id, '$date_time', '$description')";


if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}


$connect->close();
?>