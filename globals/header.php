<?php include("./globals/config.php")?>
<?php include("validate-login.php")?>

<!--Navbar-->
<script src="js/main.js" defer></script>
<!-- <script src="js/preferences.js" defer></script> -->
<!-- <script src="js/Search_bar.js" defer></script> -->
<nav>
            <div class = "logo">
               <a href="../COS221/Wines.php"><img id="Logo" src="./img/logo.png" alt="Car Paradise"></a> La Maison De Vins
            </div>
            <ul class="nav-links">
               <li><a id=Cars-link href="Wines.php" onclick="PageLoad();toggleActive()">Wines</a></li>
               <li><a id=Brands-link href="Wine_Destinations.php" onclick="toggleActive()">Wineries</a></li>
               <li><a id=Find-link href="Region.php" onclick="toggleActive()">Regions</a></li>
               
                <?php if((isset($_COOKIE['Authorised']) && $_COOKIE['Authorised'] == true) || isset($_SESSION["Email"])){
                  // echo "<li><a href=''>User Name: ".$_SESSION["AdminID"]."</a></li>";
                  echo "<li><a href='./globals/logout.php'id=LogOut'>Logout</a></li>";
                }else{
                  echo '<li><a href="./login.php">User-Login</a></li>';
                  echo '<li><a href="./admin-login.php">Admin-Login</a></li>';
                  echo '<li><a href="./signup.php">Sign-Up</a></li>';
               }?>
               
            </ul>
</nav>
