<?php
    //database information
include("../../scripts/db_connect.php");
    //Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$row = $_POST['ITEM-ROW'];
$name = $_POST['ITEM-NAME'];
$category = $_POST['ITEM-CATEGORY'];
$description = $_POST['ITEM-DESCRIPTION'];
$quantity = $_POST['ITEM-QUANTITY'];
$available = $_POST['ITEM-AVAILABLE'];
$lost = $_POST['ITEM-LOST'];
$broken = $_POST['ITEM-BROKEN'];

$category = strtolower($category);
$category = str_replace(" ", "_", $category);

$table = "inventory";
    //$statement = "UPDATE $table SET $category='$value' WHERE identification='$row'";
$statement = "UPDATE $table SET name='$name',category='$category',description='$description',quantity='$quantity',available='$available',lost='$lost',broken='$broken' WHERE identification='$row'";

if($connection->query($statement) === true){
    echo 'Update was successful';
}else{
    echo 'Error';
}

$connection->close();
?>