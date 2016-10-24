
<?php
$connect=mysqli_connect('localhost','root','','parking_permits');
 
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






	$result = $connect->query($query)->fetch_object()->password_hash;
	$result_name = $connect->query($name_query)->fetch_object()->name;
	$result_type = $connect->query($type_query)->fetch_object()->type;
	//$result_userid = $connect->query($userid_query)->fetch_object()->user_id;
	echo $result;
	echo $result_name;
	echo $pass;
	echo $result_type;
	if ($result && $result_type && $result_name && $result_userid){
    if (password_verify($pass, $result)) {
    	
    	$_SESSION['loggedIn'] = 'yes';
    	$cookie_user = "user";
		$cookie_user_value = $result_name;
		setcookie($cookie_user, $cookie_user_value, time() + (86400 * 30), "/");
		$cookie_type = "type";
		$cookie_type_value = $result_type;
		setcookie($cookie_type, $cookie_type_value, time() + (86400 * 30), "/");
		/*$cookie_userid = "user_id";
		$cookie_userid_value = $result_userid;
		setcookie($cookie_userid, $cookie_userid_value, time() + (86400 * 30), "/");

		echo "$cookie_userid_value";
		*/
		header('Location: Home.php');

} else {
    echo 'Invalid password.';
}
} else {
	echo 'sql error';
}


$connect->close();
?>