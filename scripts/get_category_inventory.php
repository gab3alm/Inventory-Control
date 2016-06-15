<?php
		// include the database data
include("db_connect.php");
		//test the connection
if($connection->connect_error){
	die("Connection to database failed ". $connection->connect_error);
}
		//Connection has been tested and we are ready to go
		//$category = $_POST['CATEGORY'];
$table = "categories";
$statement = "SELECT * FROM $table";
$category_list = $connection->query($statement);
$category_rows = $category_list->num_rows;
		//check if you have any items in the selected category
if($category_rows != 0){
	while($category_row = $category_list->fetch_assoc()){
		$table = "inventory";
		$category = $category_row['category'];
		$statement = "SELECT * FROM $table WHERE category='$category'";
		$inventory_items = $connection->query($statement);
		$inventory_items_amount = $inventory_items->num_rows;
		if($inventory_items_amount != 0){
			echo '<div id="'.$category.'_inventory" class="category-section row"><h3>'.$category.'</h3>';	
			while($single_item = $inventory_items->fetch_assoc()){
				$id = $single_item['identification'];
				$image = $single_item['image_name'];
				$name = $single_item['name'];
				$description = $single_item['description'];
				$available = $single_item['available'];
				create_inventory_item($id, $image, $name, $description, $available);
			}
			echo '</div>';
		}else{
			echo '
			<div id="'.$category.'_inventory" class="category-section row">
				<h3>'.$category.'</h3>
				<div class="col s12">
					<h4>You have no items in this category</h4>	
				</div>
			</div>
			';		
		}
	}	
}else{
			// you have no items in the category table, which is bad!
}

$connection->close();

function create_inventory_item($id, $item_image, $item_name, $item_description, $item_available){
	$card_id = "";
	$card_class= "";
	if($item_available != "0"){
		$card_id = "unselected";
	}else{
		$card_class = "red lighten-3";
	}
	echo '
	<div class="col s12 m3">
		<div id="'.$card_id.'" class="'.$id.'-item '.$card_class.' card small hoverable">
			<div class="card-image-container waves-effect waves-block waves-light">
				<img class="card-image" src="../images/inventory/'.$item_image.'">
			</div>
			<div class="card-content">
				<span class="card-title flow-text">'.$item_name.'</span>
				<p class="item_data item_description">'.$item_description.'</p>
				<p class="item_data item_available">'.$item_available.' available</p>
			</div>
		</div>
	</div>
	';
}

?>