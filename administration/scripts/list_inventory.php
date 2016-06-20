<?php
    //database information
include("../../scripts/db_connect.php");
    //Check the connection
if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}

$table = "categories";
$statement = "SELECT * FROM $table";
$result = $connection->query($statement);
$number_rows = $result->num_rows;
if($number_rows != 0){
	send_out_scripts();
	while($row = $result->fetch_assoc()){
		$table2 = "inventory";
		$target = $row["category"];
		$statement = "SELECT * FROM $table2 WHERE category='$target'";
		$items = $connection->query($statement);
		$number_items = $items->num_rows;
		if($number_items != 0){
			echo '<div id="'.$target.'" class="item-category-section">';
			echo '<h2 class="category-heading">'.$target.'</h2>';
			echo '<div class="row">';
			while($item_row = $items->fetch_assoc()){
				echo '<div class="col s12 l6"><ul class="collapsible hoverable" data-collapsible="expandable">';
				$id = $item_row["identification"]; 
				$image = $item_row["image_name"];
				$date_added = explode(" ", $item_row["date_added"]);  
				$date_only = $date_added[0];  
				$name = $item_row["name"]; 
				$category = $item_row["category"];  
				$description = $item_row["description"]; 
				$quantity = $item_row["quantity"]; 
				$available = $item_row["available"];  
				$lost = $item_row["lost"];  
				$broken = $item_row["broken"];  
				create_list_item($id, $image, $date_only, $name, $category, $description, $quantity, $available, $lost, $broken);
				echo '</ul></div>';
			}
			echo '</div></div>';
		}
	}
}
$connection->close();

function send_out_scripts(){
	echo'
	<script src="scripts/list_edit_inventory.js"></script>
	';
}


function create_list_item($id, $image, $date_only, $name, $category, $description, $quantity, $available, $lost, $broken){
	echo '
	<li id="'.$id.'" class="list-item-container">
		<div class="collapsible-header">
			<div class="row">
				<div class="col s4">
					<div class="row"><p class="list-title">name</p><p class="editable-name editable">'.$name.'</p></div>
					<div class="row name-field"></div>
				</div>
				<div class="col s4 ">
					<div class="row"><p class="list-title">category</p><p class="editable-category editable">'.$category.'</p></div>
					<div class="row category-field"></div>
				</div>
				<div class="col s4"><p class="list-title">date added</p><p class="editable">'.$date_only.'</p></div>
				<div class="action-btn-holder">
					<img class="update-btn action-btn tooltipped" data-position="left" data-delay="50" data-tooltip="Update Item" src="../images/update.svg" alt="update item">
					<img class="delete-btn action-btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete Item" src="../images/delete.svg" alt="delete item">
					<img class="submit-btn action-btn tooltipped" data-position="left" data-delay="50" data-tooltip="Submit" src="../images/submit.svg" alt="submit changes">
					<img class="cancel-btn action-btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cancel" src="../images/cancel.svg" alt="cancel changes">
				</div>
			</div>
		</div>
		<div class="collapsible-body">
			<div class="row">
				<div class="col s6 l4">
					<img class="editable-image item-image" src="../images/inventory/default.svg" alt="">
				</div>
				<div class="col s6 l8">
					<div class="row">
						<p class="editable-description editable">'.$description.'</p>
					</div>
					<div class="row description-field"></div>
				</div>
			</div>
			<div class="row">
				<div class="col s3">
					<div class="row">
						<span class="list-title">quantity: </span><p class="editable-quantity editable">'.$quantity.'</p>
					</div>
					<div class="row quantity-field"></div>
				</div>
				<div class="col s3">
					<div class="row">
						<span class="list-title">available: </span><p class="editable-available editable">'.$available.'</p>
					</div>
					<div class="row available-field"></div>
				</div>
				<div class="col s3">
					<div class="row">
						<span class="list-title">lost: </span><p class="editable-lost editable">'.$lost.'</p>
					</div>
					<div class="row lost-field"></div>
				</div>
				<div class="col s3">
					<div class="row">	
						<span class="list-title">broken: </span><p class="editable-broken editable">'.$broken.'</p>
					</div>
					<div class="row broken-field">

					</div>
				</div>
			</div>
		</div>
	</li>
	';
}






?>