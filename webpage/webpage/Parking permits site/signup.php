
<?php
$connect=mysqli_connect('localhost','root','','parking_permits');
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 
$pass = password_hash('password', PASSWORD_DEFAULT);
$name=$_POST['name'];

$department_id=$_POST['department_id'];
$email=$_POST['email'];
$password_hash=(string)$pass;
$type=$_POST['user_type'];





$sql = "INSERT INTO users(name, email, type, department_id, password_hash) VALUES ('$name', '$email', '$type','$department_id', '$password_hash')";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

//$user_id = $connect->insert_id;




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