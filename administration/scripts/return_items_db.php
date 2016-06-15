<?php
$result = "";
$item_data = array();
parse_str($_POST['encoded_items'], $item_data);
$items_being_returned = sizeof($item_data);
$total_items_due = $_POST['items_max'];
$borrower_id = $_POST['borrower_id'];


// if the user is actually returning any items
if($items_being_returned != 0){
	include("../../scripts/db_connect.php");	
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	foreach ($item_data as $key => $value){
		// key -> borrower-itemID -> 2-12
		// value -> itemNAME_itemAmountTaken -> Kino kits_1
		$key_data = explode("-", $key);
		$value_data = explode("_", $value);
		$item_id = $key_data[1];
		$item_amount = $value_data[1];
		clear_item_from_borrower($borrower_id, $item_id, $item_amount, $connection);
	}
	if($items_being_returned == $total_items_due){
		$result = clear_borrower($borrower_id, $connection);
	}
	$connection->close();
}


function clear_item_from_borrower($borrower_id, $item_id, $item_amount, $connection){
	$table = "borrowers";
	$statement = "SELECT * FROM $table WHERE identification='$borrower_id'";
	$result = $connection->query($statement);
	$borrower = $result->fetch_assoc();
	$items = json_decode($borrower["items"]);
	echo print_r($items);
	for($i= 0; $i < sizeof($items); $i++){
		// if item is found and has not been returned before
		// Structure of array
		// {[item_id][items_taken][item_return_status]}
		// item_id -> well, item identification
		// items_taken -> items taken by the borrower
		// item_return_status -> 0 - not returned || 1 -> returned
		if($items[$i][0] == $item_id && $items[$i][2] == 0){
			$items[$i][2] = 1;
			liberate_item_to_inventory($item_id, $item_amount, $connection);
		}
	}
	$serialized_data = json_encode($items);
	$statement = "UPDATE $table SET `items`='$serialized_data' WHERE  identification='$borrower_id'";
	$connection->query($statement);
}

function liberate_item_to_inventory($item_id, $item_amount, $connection){
	$table = "inventory";
	$statement = "SELECT * FROM $table WHERE identification='$item_id'";
	$item_info = $connection->query($statement);
	$item = $item_info->fetch_assoc();
	$new_available = $item["available"] + $item_amount;
	$new_in_use = $item['in_use'] - $item_amount;
	$statement = "UPDATE $table SET `available`='$new_available',`in_use`='$new_in_use' WHERE identification='$item_id'";
	$connection->query($statement);
}


function clear_borrower($borrower_id, $connection){
	$table = "borrowers";
	date_default_timezone_set('America/Los_Angeles');
	$now = date('Y-m-d H:i:s');
	$statement = "UPDATE $table SET `returned`='$now' WHERE identification='$borrower_id'";
	$connection->query($statement);
}






?>