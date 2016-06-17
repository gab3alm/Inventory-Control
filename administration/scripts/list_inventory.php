<?php

//database information
include("../../scripts/db_connect.php");
//Check the connection
if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}

$table = "inventory";
$statement = "SELECT * FROM $table";
$result = $connection->query($statement);
$rows = $results->num_rows;
if($rows != 0){
	while($item = $result->fetch_assoc()){
		
	}
}





function list_inventory_item($category, $name, $date_added, $picture, $description, $quantity, $available, $lost, $broken){
	echo '
	<li>
		<div class="collapsible-header">
			<div class="col s4 right">Category: </div>
			<div class="col s4 right">Name: </div>
			<div class="col s4 right">Date Added: </div>
			<div class="col s4"></div>
		</div>
		<div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
	</li>
	';
}






?>