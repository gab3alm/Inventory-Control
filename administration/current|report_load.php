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
	$return_button = "";
	if($return == "0000-00-00 00:00:00"){
		$return = "Not Yet";
		if($view == "current"){
			$return_button = '<div class="return-button-container"><img class="return-button tooltipped" data-position="left" data-delay="50" data-tooltip="Were the items returned? (coming soon)" src="../images/submit.svg" alt="submit"></div>';
		}
	}
	echo '
	<li>
		<div class="collapsible-header">
			<div class="row">
				<div id="borrower_id" class="col s2 m2 borrower-info"><p class="current-header">Request #</p>'.$num.'</div>
				<div id="borrower_name" class="col s10 m6 borrower-info"><p class="current-header">Student</p>'.get_borrower_name($id, $connection).'</div>
				<div id="borrower_take" class="col s6 m2 borrower-info"><p class="current-header">Checked Out</p>'.$checkout.'</div>
				<div id="borrower_return" class="col s6 m2 borrower-info"><p class="current-header">Returned</p>'.$return.'</div>
			</div>
		</div>
		<div class="collapsible-body">
			'.$return_button.'
			<p>'.get_item_list($items, $connection).'</p>
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
			$display = $display . " ". $data['name']." | ". $posts[$i][1] ."<br>";
		}
	}	
	return $display;
}


?>