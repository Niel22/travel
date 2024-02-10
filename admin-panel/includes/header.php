<?php
session_start();
define('ADMINURL', 'http://localhost/wooxtravel/admin-panel/');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?= ADMINURL?>styles/style.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      <div class="container">
      <a class="navbar-brand" href="<?= ADMINURL?>">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav side-nav" >
          <li class="nav-item">
            <a class="nav-link" style="margin-left: 20px;" href="<?= ADMINURL?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL?>admins/admins.php" style="margin-left: 20px;">Admins</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL?>countries-admins/show-country.php" style="margin-left: 20px;">Countries</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL?>cities-admins/show-cities.php" style="margin-left: 20px;">Cities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL?>bookings-admins/show-bookings.php" style="margin-left: 20px;">Bookings</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-md-auto d-md-flex">
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php if(!isset($_SESSION['admin_id'])) :?>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL?>admins/login-admins.php">login
            </a>
          </li>
          <?php else :?>
          <li class="nav-item dropdown">
            <a class="nav-link  dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= $_SESSION['username'];?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?= ADMINURL?>admins/logout.php">Logout</a>
              
          </li>
          <?php endif;?>       
          
        </ul>
      </div>
    </div>
    </nav>