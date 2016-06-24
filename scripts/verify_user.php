<?php
session_start();
//database information
include("db_connect.php");
//Check the connection
if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}

//get user login info from sign in form
//--->public/index.php
$username   = $_POST['USERNAME'];
$password   = $_POST['PASSWORD'];

//database table for users
$table_name = "users";
$statement = "SELECT * FROM $table_name WHERE username='$username'";
$result = $connection->query($statement);
$result_rows = $result->num_rows;
//only login if you have unique user
//Kinda iffy, however the user database is limited to around 5 people
if($result_rows == 1){
	//get user information
	$row_user = $result->fetch_assoc();
	$hash_pass = $row_user['password'];
	if(password_verify($password , $hash_pass) === true){
		//save session variables used to verify the identity of user
		$_SESSION['USER'] = $row_user['firstname'];
		$_SESSION['CATEGORY'] = $row_user['category'];
		if($row_user['category'] == "admin"){
			//go to admin section
			$_SESSION['LAST'] = $row_user['lastname'];
			header("location: ../administration/admin.php");
		}else{
			//go to student section
			$_SESSION['IDENTIFICATION'] = $row_user['identification'];
			header("location: ../public/inventory.php");
		}
	}else{
		//password is incorrect - gotta replace this with a nice landing page or something
		echo '<script>alert("your password is incorrect!")</script>';
		header("location: ../public/user_registration.php");
	}	
}else if($result_rows == 2){
	echo 'The username is not unique';
}else if($result_rows == 0){
	echo 'That username does not exists';
}

$connection->close();
?>