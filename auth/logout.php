<?php include "../includes/header.php";?>
<?php

if(!isset($_SESSION['username'])){
  header("location:".APPURL."");
}

?>
<?php

session_start();
session_destroy();
session_unset();

header("location:".APPURL."");

?>