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
	$fullname = array();
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
		echo '<p class="no_open_requests">All items have been turned in. Yay!</p>';
	}
	$connection->close();
}

function create_borrower($view, $num, $id, $items, $checkout, $return, $connection){
	$items_to_return = return_item_list($view, $num, $id, $items, $connection);
	if($return == "0000-00-00 00:00:00"){
		$return = "Not Yet";
	}
	echo '
	<li>
		<div class="collapsible-header">
			<div class="row">
				<div id="borrower_id" class="col s6 l2 borrower-info"><p class="current-header">Request #</p>'.$num.'</div>
				<div id="borrower_name" class="col s6 l6 borrower-info"><p class="current-header">Student</p>'.get_firstname($id, $connection).' '.get_lastname($id, $connection).' | '.get_phone($id, $connection).'</div>
				<div id="borrower_take" class="col s6 l2 borrower-info"><p class="current-header">Checked Out</p>'.$checkout.'</div>
				<div id="borrower_return" class="col s6 l2 borrower-info"><p class="current-header">Returned</p>'.$return.'</div>
			</div>
		</div>
		<div class="collapsible-body">
			<div class="row">
				<div class="col push-l2 l6 m4 hide-on-small-only center-align"><img class="borrower-image" src="../images/users/'.get_firstname($id, $connection).'_'.get_lastname($id, $connection).'.png" alt="user image"></div>
				<div class="col s6 m4 push-l2 l4 left-align"><div class="item_list_container">'.get_item_list($items, $connection).'</div></div>
				<div class="col s6 m4 l2 left-align"><div class="item_list_container">'.$items_to_return.'</div></div>
			</div>
		</div>
	</li>
	';
}


function get_firstname($identification, $connection){
	$table = "users";
	$statement = "SELECT * FROM $table WHERE identification='$identification'";
	$result = $connection->query($statement);
	$borrower = $result->fetch_assoc();
	return $borrower['firstname'];
}

function get_lastname($identification, $connection){
	$table = "users";
	$statement = "SELECT * FROM $table WHERE identification='$identification'";
	$result = $connection->query($statement);
	$borrower = $result->fetch_assoc();
	return $borrower['lastname'];
}

function get_phone($identification, $connection){
	$table = "users";
	$statement = "SELECT * FROM $table WHERE identification='$identification'";
	$result = $connection->query($statement);
	$borrower = $result->fetch_assoc();
	return $borrower['phone'];
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

function return_item_list($view, $request_num, $id, $items, $connection){
	$posts = json_decode($items);
	$input = "";
	$max = sizeOf($posts);
	$display = "<form id='item_return_".$request_num."'>";
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
			if($posts[$i][2] == "1"){
				$input = '<input name="'.$id.'-'.$data['identification'].'" type="checkbox" checked="checked" class="return_field filled-in" id="'.$field_id.'" value="'.$field_value.'"/>';
			}else{
				$input = '<input name="'.$id.'-'.$data['identification'].'" type="checkbox" class="return_field filled-in" id="'.$field_id.'" value="'.$field_value.'"/>';
			}
			$radio_display = '
			<p class="return_form_field">
				'.$input.'
				<label class="return_label" for="'.$field_id.'">'.$field_label.'</label>
			</p>
			';
			$display =  $display.$radio_display;
		}
	}
	$submit_button = "";
	if($view == "current"){
		$submit_button = "<button id='".$request_num."' class='".$max." waves-effect waves-teal red lighten-2 custm-btn btn'>Submit</button>";	
	}
	$display = $display.$submit_button."</form>";
	return $display;
}


?>