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
    echo '<h2 class="category-heading">'.$target.'</h2>';
    echo '<div class="row">';
    while($item_row = $items->fetch_assoc()){
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
     create_item_card($id, $image, $date_only, $name, $category, $description, $quantity, $available, $lost, $broken);
   }
   echo '</div>';
 }
}
}
$connection->close();

function send_out_scripts(){
  echo'
  <script src="scripts/edit_inventory.js"></script>
  ';
}

function create_item_card($id, $image, $date_added, $name, $category, $description, $quantity, $available, $lost, $broken){
  echo '
  <div class="col s12 m6 l3">
    <div id="'.$id.'-card" class="card item_card hoverable">
      <div class="card-image">
        <div class="row">
         <div class="btn-holder">
          <img id="'.$id.'-delete" class="card-action-item delete-btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete Item" src="../images/delete.svg">
        </div> 
        <div class="btn-holder">
          <img id="'.$id.'-update" class="card-action-item update-btn tooltipped" data-position="left" data-delay="50" data-tooltip="Update Item Information" src="../images/update.svg">
        </div> 
      </div>
      <img id="'.$id.'-image_name" class="item-image" src="../images/inventory/'.$image.'">
    </div>
    <div class="card-content">
      <span id="'.$id.'-name" class="card-title editable-data">'.$name.'</span>
      <div class="row">
        <div class="col s3 m4"><p class="data-label">date: </p></div>
        <div class="col s9 m8"><p class="item-data left-align">'.$date_added.'</p></div>
      </div>
      <div class="row">
        <div class="col s3 m4"><p class="data-label">category: </p></div>
        <div class="col s9 m8"><p id="'.$id.'-category" class="item-data editable-data">'.$category.'</p></div>
      </div>
      <div class="row">
        <div class="col s3 m4"><p class="data-label">description: </p></div>
        <div class="col s9 m8"><p id="'.$id.'-description" class="item-data item-description editable-data">'.$description.'</p></div>
      </div>
      <div class="row">
        <div class="col s3">
          <p class="data-label">quantity</p>
          <p id="'.$id.'-quantity" class="item-number editable-data">'.$quantity.'</p>
        </div>
        <div class="col s3">
          <p class="data-label">available</p>
          <p id="'.$id.'-available" class="item-number editable-data">'.$available.'</p>
        </div>
        <div class="col s3">
          <p class="data-label">lost</p>
          <p id="'.$id.'-lost" class="item-number editable-data">'.$lost.'</p>
        </div>
        <div class="col s3">
          <p class="data-label">broken</p>
          <p id="'.$id.'-broken" class="item-number editable-data">'.$broken.'</p>
        </div>
      </div>
    </div>
  </div>
</div>
';   
}
?>