
<?php
$connect=mysqli_connect('localhost','root','qwerty','parking_permits');
 
session_start();

if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 
$pass = $_POST['password'];



$email=$_POST['email'];





$query = "SELECT password_hash FROM users WHERE email = '$email'"  ;
$name_query = "SELECT name FROM users WHERE email = '$email'";
$type_query = "SELECT type FROM users WHERE email = '$email'";

//$result=mysql_query($query);
//echo $result;






	$result = $connect->query($query)->fetch_object()->password_hash;
	$result_name = $connect->query($name_query)->fetch_object()->name;
	$result_type = $connect->query($type_query)->fetch_object()->type;
	echo $result;
	echo $result_name;
	echo $pass;
	echo $result_type;
    if (password_verify($pass, $result)) {
    	
    	$_SESSION['loggedIn'] = 'yes';
    	$cookie_user = "user";
		$cookie_user_value = $result_name;
		setcookie($cookie_user, $cookie_user_value, time() + (86400 * 30), "/");
		$cookie_type = "type";
		$cookie_type_value = $result_type;
		setcookie($cookie_type, $cookie_type_value, time() + (86400 * 30), "/");
		header('Location: ParkingPermits.php');

} else {
    echo 'Invalid password.';
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