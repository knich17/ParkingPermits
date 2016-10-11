
<?php
$connect=mysqli_connect('localhost','root','qwerty','parking_permits');
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 

$name=$_POST['firstname'];

$department_id=$_POST['department_id'];
$email=$_POST['email'];
$vehicle_rego=$_POST['plate'];
$vehicle_type=$_POST['vehicle_type'];
$type=$_POST['user_type'];

$start_date=date('d/m/y', strtotime($_POST['start_date']));
$end_date = date('d/m/y', strtotime($_POST['start_date']));
$status = "pending";



$sql = "INSERT INTO users(name, email, type, department_id) VALUES ('$name', '$email', '$type',$department_id)";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

$user_id = $connect->insert_id;


$sql = "INSERT INTO permits(vehicle_rego, vehicle_type, user_id, department_id, start_date, end_date, status) VALUES ('$vehicle_rego', '$vehicle_type',$user_id, $department_id, '$start_date', '$end_date', '$status')";
if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "id: " . $row["id"]. " - Name: " . $row["name"]. " <br>";
//     }
// } else {
//     echo "0 results";
// }
$connect->close();
?>