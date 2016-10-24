
<?php
session_start();
$connect=mysqli_connect('localhost','root','','parking_permits');
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}

$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$name=$_POST['name'];

$department_id=$_POST['department_id'];
$email=$_POST['email'];
//$password_hash=(string)$pass;
$type=$_POST['user_type'];





$sql = "INSERT INTO users(name, email, type, department_id, password_hash) VALUES ('$name', '$email', '$type','$department_id', '$password_hash')";


if ($connect->query($sql) === TRUE) {
    
    	$_SESSION['loggedIn'] = 'yes';
    	$cookie_user = "user";
		$cookie_user_value = $name;
		setcookie($cookie_user, $cookie_user_value, time() + (86400 * 30), "/");
		$cookie_type = "type";
		$cookie_type_value = $type;
		setcookie($cookie_type, $cookie_type_value, time() + (86400 * 30), "/");
		$user_id = $connect->insert_id;
		$cookie_userid = "userid";
		$cookie_userid_value = $user_id;
		setcookie($cookie_userid, $cookie_userid_value, time() + (86400 * 30), "/");
		echo $cookie_userid_value;
		//header('Location: Home.php');
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