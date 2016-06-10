<!-- <?php
session_start();
if($_SESSION['CATEGORY'] == 'admin' && $_SESSION['USER'] != ""){
  $user = ucfirst($_SESSION['USER']);	
}else{
  header("location: ../public/user_login.php");
}
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Item registration</title>
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
            <div class="nav-wrapper red darken-3">
                <a href="" class="brand-logo">
                    <span class="brand">Inventory Control</span>
                </a>
                <ul id="nav-mobile" class="right hide-on-sm">
                    <li class="menu-item"><a class="current" href="">current</a></li>
                    <li class="menu-item"><a class="reports" href="">reports</a></li>
                    <li class="menu-item"><a class="inventory" href="">inventory</a></li>
                </ul>
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
            <div class="row">
                <div class="col s12 center-align">
                    <div class="footer red lighten-1">
                        <p class="credits">CSUN career center | vidteam &copy; 2016</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>



</body>

</html>