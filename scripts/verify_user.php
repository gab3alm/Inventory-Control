<?php
session_start();

    //database information
include("db_connect.php");
    //Check the connection
if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}

$username   = $_POST['USERNAME'];
$password   = $_POST['PASSWORD'];

$table_name = "users";
$statement = "SELECT * FROM $table_name WHERE username='$username'";
$result = $connection->query($statement);
$result_rows = $result->num_rows;
if($result_rows == 1){
	$row_user = $result->fetch_assoc();
	$hash_pass = $row_user['password'];
	if(password_verify($password , $hash_pass) === true){
		$_SESSION['USER'] = $row_user['firstname'];
		$_SESSION['CATEGORY'] = $row_user['category'];
		if($row_user['category'] == "admin"){
			$_SESSION['LAST'] = $row_user['lastname'];
			header("location: ../administration/admin.php");
		}else{
			$_SESSION['IDENTIFICATION'] = $row_user['identification'];
			header("location: ../public/inventory.php");
		}
	}else{
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