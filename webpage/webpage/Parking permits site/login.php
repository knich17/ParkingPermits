
<?php
$connect=mysqli_connect('localhost','root','qwerty','parking_permits');
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 
$pass = $_POST['password'];



$email=$_POST['email'];





$query = "SELECT password_hash FROM users WHERE email = '$email'"  ;

//$result=mysql_query($query);
//echo $result;






	$result = $connect->query($query)->fetch_object()->password_hash;
	echo $result;
	echo $pass;
    if (password_verify($pass, $result)) {
    echo 'Password is valid!';
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