<?php
session_start();
//database information
include("db_connect.php");
//Check the connection
if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}
$table = "borrowers";
$student_id = $_SESSION["IDENTIFICATION"];
$data = $_POST["SERIALIZED-ITEMS"];
$statement = "INSERT INTO $table (`borrower`, `items`) VALUES ('$student_id', '$data')";
if($connection->query($statement) === true){
	//once items have been registered to the user
	//we need to decrease their available value in the inventory database
	$real_data = json_decode($data);
	$table = "inventory";
	$max = sizeof($real_data);
	for($i=0; $i < $max; $i++ ){
		$item_id = $real_data[$i][0];
		$statement = "SELECT * FROM $table where identification='$item_id'";
		$item = $connection->query($statement);
		$item_info = $item->fetch_assoc();
		$available = $item_info['available'];
		$items_taken = $real_data[$i][1];
		$available -= $items_taken;
		$statement = "UPDATE $table SET `available`=$available,`in_use`=$items_taken WHERE identification = '$item_id'";
		$connection->query($statement);
	}
	echo 'success';
}else{
	echo 'Request could not be processed';
}

$connection->close();
?>