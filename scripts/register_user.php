<?php

    
    //database information
    include("db_connect.php");
    //Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $username   = $_POST['USERNAME'];
    $password   = password_hash($_POST['PASSWORD'], PASSWORD_DEFAULT);
    $first_name = $_POST['FIRST'];
    $last_name  = $_POST['LAST'];
    $phone      = $_POST['PHONE'];
	
	$statement = "INSERT INTO `users`(`username`, `password`, `firstname`, `lastname`, `phone`) VALUES ('$username','$password','$first_name','$last_name','$phone')";
	if($connection->query($statement)=== true){
		header("location: ../public/index.php");
	}else{
		header("location: ../public/user_registration.php");
	}
        



$connection->close();
?>