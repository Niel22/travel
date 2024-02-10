<?php

session_start();
define("APPURL", "http://localhost/wooxtravel/");

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <title>WoOx Travel</title>

  <!-- Bootstrap core CSS -->
  <link href="<?= APPURL ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="<?= APPURL ?>assets/css/fontawesome.css">
  <link rel="stylesheet" href="<?= APPURL ?>assets/css/templatemo-woox-travel.css">
  <link rel="stylesheet" href="<?= APPURL ?>assets/css/owl.css">
  <link rel="stylesheet" href="<?= APPURL ?>assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  
  

</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="<?= APPURL ?>" class="logo">
              <img src="<?= APPURL ?>assets/images/logo.png" alt="">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="<?= APPURL ?>" class="active">Home</a></li>
              <li><a href="<?= APPURL ?>deals.php">Deals</a></li>
              <?php if(isset($_SESSION['user_id'])) :?>
                <li><a href="#"><?= $_SESSION['username']?></a></li>
              <li><a href="<?= APPURL ?>auth/logout.php">Logout</a></li>
              <li><a href="<?= APPURL ?>users/user.php?id=<?= $_SESSION['user_id']?>">Your Bookings</a></li>
              <?php else:?>
              <li><a href="<?= APPURL ?>auth/login.php">Login</a></li>
              <li><a href="<?= APPURL ?>auth/register.php">Register</a></li>
              <?php endif; ?>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>