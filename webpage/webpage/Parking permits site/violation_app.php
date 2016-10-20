
<?php
$connect=mysqli_connect('localhost','root','qwerty','parking_permits');
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 
$date_time=date('Y-m-d H:i:s', strtotime($_POST['date_time']));

$violation_desc=$_POST['violation_desc'];
$violation_type=$_POST['violation_type'];

$permit_id=$_POST['permit_id'] ?: 'NULL';
$rego=$_POST['rego'];
$vehicle_type=$_POST['vehicle_type'];

$violator_name=$_POST['violator_name'];
$department_id=$_POST['department_id'];
$supervisor=$_POST['supervisor'];
$place=$_POST['place'];

//$user_id = $connect->insert_id;
//TODO USE COOKIE OR WHAT EVER FOR INSERTING FOR THE CORRECT USER

$sql = "INSERT INTO citations(admin_id, time, description) VALUES ('1', '$date_time', '$violation_desc')";
$sql2 = "";
if ($connect->query($sql) === TRUE) {
	$citation_id = $connect->insert_id;
	if ($violation_type == "1") {
		$sql2 = "INSERT INTO parking_citations(citation_id, permit_id, rego, vehicle_type) VALUES ('$citation_id', $permit_id, '$rego', '$vehicle_type')";
	} else {
		$sql2 = "INSERT INTO smoking_citations(citation_id, violator_name, department_id, supervisor_name, location) VALUES ('$citation_id', '$violator_name', '$department_id', '$supervisor', '$place')";
	}
	if ($connect->query($sql2) === TRUE) {
		echo "Both records created sucessfully";
	} else {
    	echo "Error2: " . $sql2 . "<br>" . $connect->error;
	}
    //echo "New record created successfully";
} else {
    echo "Error1: " . $sql . "<br>" . $connect->error;
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