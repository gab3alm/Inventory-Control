<?php
session_start();
if($_SESSION['CATEGORY'] == 'admin' && $_SESSION['USER'] != ""){
  $user = ucfirst($_SESSION['USER']);	
}else{
  header("location: ../public/user_login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Inventory Administration</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="../sass/admin.css">
  <link rel="stylesheet" href="../sass/admin_inventory.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="../resources/materialize.js"></script>
  <script src="scripts/admin_scripts.js"></script>
</head>

<body>
  <!--|||||||||||||||||||||||||||||||||||||-->
  <!--|||NAVIGATION BAR 					 -->
  <!--|||||||||||||||||||||||||||||||||||||-->
  <div class="container-fluid">
    <nav>
      <div class="row admin-navbar">
        <!-- application logo -->
        <div class="col l3 hide-on-med-and-down center-align">
          <a href="admin.php"><img class="app-logo" src="../images/logo.svg" alt="vidteam logo"></a>
        </div>
        <!-- user image -->
        <div class="col l6 center-align hide-on-med-and-down">
          <?php 
          $user_name = $_SESSION['USER'] ."_".$_SESSION['LAST'];
          $image_path = '<img class="admin_avatar" src="../images/users/'.$user_name.'.png" alt="USER IMAGE">';
          echo $image_path;
          ?>
          <img class="navbar-triangle" src="../images/triangle.svg" alt="triangle part of navbar">
        </div>
        <!-- many items section-->
        <!-- Im pushing l6 because the img elements are position:absolute -->
        <div class="col push-l6 l3 s12 right-align">
          <!-- Logout button -->
          <div class="row navrow logout-row">
            <button class="cust-btn btn waves-effect waves-light white darken-1">Logout</button>
          </div>
          <!-- application name -->
          <div class="row navrow app-name-row">
            <span class="application-name">equipment checkout</span>
          </div>
          <!-- navigation bar -->
          <div class="row navrow menu-row">
            <a class="current" href="">current</a>
            <a class="reports" href="">reports</a>
            <a class="inventory" href="">inventory</a>
          </div>
          <div id="inventory_views" class="row navrow menu-row">
            <a class="card_view" href="#!">Card</a>
            <a class="list_view" href="#!">List</a>
          </div>
        </div>                           
      </div>
    </nav>

    <!--|||||||||||||||||||||||||||||||||||||-->
    <!--|||AREA TO LOAD THE TABS 			 -->
    <!--|||||||||||||||||||||||||||||||||||||-->
    <div class="row">
      <div class="col s12 center-align">
        <div id="application_area">

        </div>
      </div>
    </div>



    <!--|||||||||||||||||||||||||||||||||||||-->
    <!--|||FOOTER SECTION 	 	 			 -->
    <!--|||||||||||||||||||||||||||||||||||||-->
    <footer>
      <div class="footer">
        <div class="row">
          <div class="col s12 push-l5 l10">
            <p class="credits">CSUN career center | vidteam &copy; 2016</p>
          </div>
          <div class="col s12 l2">
            <img class="cc_logo" src="../images/cc_logo.svg" alt="career center logo">
          </div>
        </div>
      </div>
    </footer>
  </div>



</body>

</html>