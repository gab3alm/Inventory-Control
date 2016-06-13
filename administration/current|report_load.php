<?php
$decision = $_POST['ACTION'];
if($decision == "current"){
	create_view("current");
}else if($decision == "report"){
	create_view("report");
}else{
	// I dont know what you are trying to do!
}

function create_view($view){
		// database information
	include("../scripts/db_connect.php");
		// check the database connection 
	if($connection->connect_error){
		die("Connection failed ". $connection->connect_error);
	}
		//We have a good connection, lets do whatever we gotta do
	$table = "borrowers";
	$statement = "";
	$heading = "";
	if($view == "current"){
		$heading = '<p class="view-heading">Current Items</p>';
		$statement = "SELECT * FROM $table WHERE returned='0000-00-00 00:00:00'";
	}else if($view == "report"){
		$heading = '<p class="view-heading">Request History</p>';
		$statement = "SELECT * FROM $table";
	}
	$borrowers = $connection->query($statement);
	$numb_borrowers = $borrowers->num_rows;
	if($numb_borrowers != 0){
		echo $heading;
		// we have borrowers in the database
		while($borrower_info = $borrowers->fetch_assoc()){
			echo '<ul class="collapsible" data-collapsible="expandable">';
			$id = $borrower_info['identification'];
			$borrower_id = $borrower_info['borrower'];
			$borrower_data = $borrower_info['items'];
			$borrower_checkout = $borrower_info['date'];
			$borrower_return = $borrower_info['returned'];
			create_borrower($view, $id, $borrower_id, $borrower_data, $borrower_checkout, $borrower_return, $connection);
			echo '</ul>';
		}
	}else{
		echo 'You have no items out in the field';
	}
	$connection->close();
}

function create_borrower($view, $num, $id, $items, $checkout, $return, $connection){
	$items_to_return = "";
	if($return == "0000-00-00 00:00:00"){
		$return = "Not Yet";
		if($view == "current"){
			$items_to_return = return_item_list($num, $id, $items, $connection);
		}
	}
	echo '
	<li>
		<div class="collapsible-header">
			<div class="row">
				<div id="borrower_id" class="col s6 l2 borrower-info"><p class="current-header">Request #</p>'.$num.'</div>
				<div id="borrower_name" class="col s6 l6 borrower-info"><p class="current-header">Student</p>'.get_borrower_name($id, $connection).'</div>
				<div id="borrower_take" class="col s6 l2 borrower-info"><p class="current-header">Checked Out</p>'.$checkout.'</div>
				<div id="borrower_return" class="col s6 l2 borrower-info"><p class="current-header">Returned</p>'.$return.'</div>
			</div>
		</div>
		<div class="collapsible-body">
			<div class="row">
				<div class="col push-l2 l6 m4 hide-on-small-only center-align"><img class="borrower-image" src="../images/success.svg" alt="user image"></div>
				<div class="col s6 m4 push-l2 l4 left-align"><div class="item_list_container">'.get_item_list($items, $connection).'</div></div>
				<div class="col s6 m4 l2 left-align"><div class="item_list_container">'.$items_to_return.'</div></div>
			</div>
		</div>
	</li>
	';
}


function get_borrower_name($identification, $connection){
	$table = "users";
	$statement = "SELECT * FROM $table WHERE identification='$identification'";
	$result = $connection->query($statement);
	$found = $result->num_rows;
	$name = ""
	;	if($found != 0){
		$borrower = $result->fetch_assoc();
		$name = $borrower['firstname'] ." ". $borrower['lastname'] ." | ". $borrower['phone'];
	}else{
		$name = "User not found!";
	}
	return $name;
}


function get_item_list($items, $connection){
	$posts = json_decode($items);
	$max = sizeOf($posts);
	$display = "";
	for($i = 0; $i < $max; $i++){
		$table = "inventory";
		$item_id = $posts[$i][0];
		$statement = "SELECT * FROM $table WHERE identification='$item_id'";
		$item = $connection->query($statement);
		$item_exist = $item->num_rows;
		if($item_exist != -1){
			$data = $item->fetch_assoc();
			$quantity_display = "<p class='items-taken'>".$posts[$i][1]."</p>";
			$name_display = $data['name'];
			$display =  $display.$quantity_display.$name_display." |<br>";
		}
	}	
	return $display;
}

function return_item_list($request_num, $id, $items, $connection){
	$posts = json_decode($items);
	$max = sizeOf($posts);
	$display = "<form action='./scripts/return_items_db.php' method='POST'>";
	$unique_field = 9999;
	for($i = 0; $i < $max; $i++, $unique_field--){
		$table = "inventory";
		$item_id = $posts[$i][0];
		$statement = "SELECT * FROM $table WHERE identification='$item_id'";
		$item = $connection->query($statement);
		$item_exist = $item->num_rows;
		if($item_exist != -1){
			$data = $item->fetch_assoc();
			$field_id = $id."-".$data['name']."-".$unique_field;
			$field_label = $data['name']." | ".$posts[$i][1];
			$field_value = $data['name']."_".$posts[$i][1];
			$radio_display = '
			<p class="return_form_field">
				<input type="checkbox" class="return_field filled-in" id="'.$field_id.'" value="'.$field_value.'"/>
				<label class="return_label" for="'.$field_id.'">'.$field_label.'</label>
			</p>
			';
			$display =  $display.$radio_display;
		}
	}
	$submit_button = "<button type='submit' class='waves-effect waves-teal red lighten-2 custm-btn btn'>Submit</button>";	
	$display = $display.$submit_button."</form>";
	return $display;
}


?>