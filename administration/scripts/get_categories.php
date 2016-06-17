<?php
$current_category = $_POST['CURRENT-CATEGORY'];
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
    while($row = $result->fetch_assoc()){
        if($current_category == $row['category']){
            create_dropdown_category($row["category"], "selected");
        }else{
            create_dropdown_category($row["category"], "");
        }
    }
}else{
    create_dropdown_category("Oops, something went wrong");
}


function create_dropdown_category($category, $selected){
    $cap = ucwords(str_replace("_", " ", $category));
    if($selected == ""){
        echo '<option class="select_option" value="'.$category.'">'.$cap.'</option>';
    }else{
        echo '<option class="select_option" value="'.$category.'" selected>'.$cap.'</option>';
    }

}
?>