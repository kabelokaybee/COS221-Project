<?php 
   // destroy the session
   session_start();
   session_unset();
   session_destroy();
   setcookie("Authorised","",time() - (86400 * 30),"/");
   // redirect to another page
   header("Location: ../Wines.php");
   exit; 
?>