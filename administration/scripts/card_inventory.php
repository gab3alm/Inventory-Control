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
        $clean_target = strtoupper($target);
        echo '<div id="'.$clean_target.'" class="item-category-section">';
        $clean_title = str_replace("_", " ", $target);
        $clean_title = ucwords($clean_title);
        echo '<h2 class="category-heading">'.$clean_title.'</h2>';
        echo '<div class="row">';
        while($item_row = $items->fetch_assoc()){
           $id = $item_row["identification"]; 
           $image = $item_row["image_name"];
           $date_added = explode(" ", $item_row["date_added"]);  
           $date_only = $date_added[0];  
           $name = $item_row["name"]; 
           $category = $item_row["category"];  
           $category = str_replace("_", " ", $category);
           $category = ucwords($category);
           $description = $item_row["description"]; 
           $quantity = $item_row["quantity"]; 
           $available = $item_row["available"];  
           $lost = $item_row["lost"];  
           $broken = $item_row["broken"];  
           create_item_card($id, $image, $date_only, $name, $category, $description, $quantity, $available, $lost, $broken);
       }
       echo '</div></div>';
   }
}
}
$connection->close();

function send_out_scripts(){
  echo'
  <script src="scripts/card_edit_inventory.js"></script>
  ';
}

function create_item_card($id, $image, $date_added, $name, $category, $description, $quantity, $available, $lost, $broken){
  echo '
  <div class="col s12 m6 l3 card_element" id="'.$id.'">
    <div class="card item_card hoverable">
      <div class="row">
        <div class="action-btn-holder">

          <img class="card-action-item update-btn tooltipped" data-position="left" data-delay="50" data-tooltip="Update" src="../images/update.svg">

          <img class="card-action-item delete-btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" src="../images/delete.svg">

          <img class="card-action-item submit-btn tooltipped" data-position="left" data-delay="50" data-tooltip="Submit" src="../images/submit.svg">

          <img class="card-action-item cancel-btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cancel" src="../images/cancel.svg">

      </div> 
  </div>
  <div class="card-image">
    <img class="item-image editable-image" src="../images/inventory/'.$image.'">
</div>
<div class="card-content">
    <!-- NAME IS EDITABLE-->
    <span class="card-title editable-data editable-name">'.$name.'</span>
    <div class="row name-field"></div>


    <!-- DATE ADDED IS NOT EDITABLE-->
    <div class="row">
      <div class="col s3 m4"><p class="data-label">date: </p></div>
      <div class="col s9 m8">
        <p class="item-data left-align">'.$date_added.'</p>
    </div>
</div>

<!-- CATEGORY IS EDITABLE-->
<div class="row">
  <div class="col s3 m4"><p class="data-label">category: </p></div>
  <div class="col s9 m8">
    <p class="item-data editable-data editable-category">'.$category.'</p>
    <div class="row category-field"></div>
</div>
</div>

<!-- DESCRIPTION IS EDITABLE-->
<div class="row">
  <div class="col s3 m4"><p class="data-label">description: </p></div>
  <div class="col s9 m8">
    <p class="item-data item-description editable-data editable-description">'.$description.'</p>
    <div class="row description-field"></div>
</div>
</div>

<div class="row">

  <!-- QUANTITY IS EDITABLE-->
  <div class="col s3">
    <p class="data-label">quantity</p>
    <p class="item-number editable-data editable-quantity">'.$quantity.'</p>
    <div class="row quantity-field"></div>
</div>

<!-- AVAILABLE IS EDITABLE-->
<div class="col s3">
    <p class="data-label">available</p>
    <p class="item-number editable-data editable-available">'.$available.'</p>
    <div class="row available-field"></div>
</div>

<!-- LOST IS EDITABLE-->
<div class="col s3">
    <p class="data-label">lost</p>
    <p class="item-number editable-data editable-lost">'.$lost.'</p>
    <div class="row lost-field"></div>
</div>

<!-- BROKEN IS EDITABLE-->
<div class="col s3">
    <p class="data-label">broken</p>
    <p class="item-number editable-data editable-broken">'.$broken.'</p>
    <div class="row broken-field"></div>
</div>


</div>
</div>
</div>
</div>
';   
}
?>