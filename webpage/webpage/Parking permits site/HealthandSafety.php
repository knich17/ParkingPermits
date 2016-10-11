
<?php
$connect=mysqli_connect('localhost','root','qwerty','parking_permits');
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 

$name=$_POST['name'];

$department_id=$_POST['department_id'];


$date_time=date('d/m/y', strtotime($_POST['date_time']));


$sql = "INSERT INTO users(name, department_id, date_time, description) VALUES ('$name',$department_id, 'date_time', 'description')";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}


$connect->close();
?>