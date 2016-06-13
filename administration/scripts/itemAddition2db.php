<?php
  	//database information
    include("../../scripts/db_connect.php");
    //Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

	$name = $_POST['ITEM-NAME'];
	$category = $_POST['ITEM-CATEGORY'];
	$description = $_POST['ITEM-DESCRIPTION'];
	$quantity = $_POST['ITEM-QUANTITY'];
	$available = $_POST['ITEM-QUANTITY'];

	$statement = "INSERT INTO `inventory`(`name`, `category`, `description`, `quantity`, `available`) VALUES ('$name','$category','$description','$quantity','$available')";
	if($connection->query($statement)=== true){
		echo 'Item has been added successfully!';
	}

	$connection->close();
?>