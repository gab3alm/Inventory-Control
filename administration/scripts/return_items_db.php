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
		// STRUCTURE : key -> borrowerID-itemID -> 2-12
		// STRUCTURE : value -> itemNAME_itemAmountTaken -> Kino kits_1
		//explode splits the string into an array.
		$key_data = explode("-", $key);
		$value_data = explode("_", $value);
		$item_id = $key_data[1];
		$item_amount = $value_data[1];
		//return an item back to inventory
		clear_item_from_borrower($borrower_id, $item_id, $item_amount, $connection);
	}

	//if all items are returned then completely clear the borrower.
	if($items_being_returned == $total_items_due){
		$result = clear_borrower($borrower_id, $connection);
	}
	$connection->close();
}

/**
 * [clear_item_from_borrower : clears 1 item from a borrower]
 * @param  [integer] $borrower_id 					[borrower id describes an unique borrower in the borrowers table]
 * @param  [integer] $item_id     					[unique id of item in the inventory table]
 * @param  [integer] $item_amount 					[amount taken from the item]
 * @param  [$connection object to db] $connection 	[connection object to db]
 * @return [void]              						[description]
 */
function clear_item_from_borrower($borrower_id, $item_id, $item_amount, $connection){
	$table = "borrowers";
	$statement = "SELECT * FROM $table WHERE identification='$borrower_id'";
	$result = $connection->query($statement);
	$borrower = $result->fetch_assoc();
	//items is an array after decoding from db data
	$items = json_decode($borrower["items"]);
	for($i= 0; $i < sizeof($items); $i++){
		// if item is found and has not been returned before
		// Structure of array
		//        0        1           2
		// {[item_id][items_taken][item_return_status]}
		// item_id -> well, item identification (inventory table)
		// items_taken -> items taken by the borrower
		// item_return_status -> 0 - not returned || 1 -> returned
		if($items[$i][0] == $item_id && $items[$i][2] == 0){
			$items[$i][2] = 1;
			liberate_item_to_inventory($item_id, $item_amount, $connection);
		}
	}
	// encode the modified user cart and update the db
	$serialized_data = json_encode($items);
	$statement = "UPDATE $table SET `items`='$serialized_data' WHERE  identification='$borrower_id'";
	$connection->query($statement);
}

/**
 * [liberate_item_to_inventory : adjusts the available values of an item after it is returned]
 * @param  [int] $item_id     		[unique item identifier in (inventory) table]
 * @param  [int] $item_amount 		[amount taken from item]
 * @param  [object] $connection  	[connection object to db]
 * @return [void]              		[Just updates the database information]
 */
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

/**
 * [clear_borrower : Clears borrower and sets his item request status as returned]
 * @param  [int] $borrower_id 		[unique borrower identifier in (borrower) table]
 * @param  [object] $connection  	[connection object to db]
 * @return [void]              		[update borrower table]
 */
function clear_borrower($borrower_id, $connection){
	$table = "borrowers";
	date_default_timezone_set('America/Los_Angeles');
	$now = date('Y-m-d H:i:s');
	$statement = "UPDATE $table SET `returned`='$now' WHERE identification='$borrower_id'";
	$connection->query($statement);
}
?>