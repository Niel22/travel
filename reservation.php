<?php include "includes/header.php"; ?>
<?php include "config/server.php"; ?>
<!-- ***** Header Area End ***** -->
<?php

if (!isset($_SESSION['username'])) {
  header("location:" . APPURL . "auth/login.php");
}

?>

<div class="reservation-form">
  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $city = $conn->prepare("SELECT * FROM cities WHERE id = :id");
    $city->bindParam(':id', $id);
    $city->execute();

    $getCity = $city->fetch(PDO::FETCH_OBJ);
  }


  if (isset($_POST['submit'])) {

    if (empty($_POST['name']) || empty($_POST['number']) || empty($_POST['guest']) || empty($_POST['date'])) {

      echo '<div class="alert alert-danger" role="alert">
      Input field cannot be empty!
      </div>';

    } else {

      $name = $_POST['name'];
      $number = $_POST['number'];
      $guest = $_POST['guest'];
      $date = $_POST['date'];
      $destination = $getCity->name;
      $status = 'pending';
      $city_id = $id;
      $user_id = $_SESSION['user_id'];
      $payment = $guest * $getCity->price;

      $_SESSION['payment'] = $payment;

      if(date("Y-m-d") < $date){

      $insert = $conn->prepare("INSERT INTO bookings (name, phone_number, num_guests, checkin_date, destination, status, city_id, user_id, payment) VALUES (:name, :number, :guest, :date, :destination, :status, :city_id, :user_id, :payment)");
      $insert->bindParam(":name", $name);
      $insert->bindParam(":number", $number);
      $insert->bindParam(":guest", $guest);
      $insert->bindParam(":date", $date);
      $insert->bindParam(":destination", $destination);
      $insert->bindParam(":status", $status);
      $insert->bindParam(":city_id", $city_id);
      $insert->bindParam(":user_id", $user_id);
      $insert->bindParam(":payment", $payment);
      $insert->execute();

      if ($insert) {
        header("location:". APPURL ."pay.php");
      }
    }else{
      echo '<div class="alert alert-danger" role="alert">
      You cannot make reservation for a past date!
      </div>';
    }
  }
  }

  ?>

  <div class="second-page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h4>Book Prefered Deal Here</h4>
          <h2>Make Your Reservation</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt uttersi labore et
            dolore magna aliqua is ipsum suspendisse ultrices gravida</p>
        </div>
      </div>
    </div>
  </div>

  <div class="more-info reservation-info">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-6">
          <div class="info-item">
            <i class="fa fa-phone"></i>
            <h4>Make a Phone Call</h4>
            <a href="#">+123 456 789 (0)</a>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="info-item">
            <i class="fa fa-envelope"></i>
            <h4>Contact Us via Email</h4>
            <a href="#">company@email.com</a>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="info-item">
            <i class="fa fa-map-marker"></i>
            <h4>Visit Our Offices</h4>
            <a href="#">24th Street North Avenue London, UK</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="reservation-form">
    <div class="container">
      <div class="row">

        <div class="col-lg-12">
          <form id="reservation-form" method="post" role="search" action="reservation.php?id=<?= $id; ?>">
            <div class="row">
              <div class="col-lg-12">
                <h4>Make Your <em>Reservation</em> Through This <em>Form</em></h4>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="Name" class="form-label">Your Name</label>
                  <input type="text" name="name" class="Name" placeholder="Ex. John Smithee" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="Number" class="form-label">Your Phone Number</label>
                  <input type="text" name="number" class="Number" placeholder="Ex. +xxx xxx xxx" autocomplete="on"
                    required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="chooseGuests" class="form-label">Number Of Guests</label>
                  <input type="number" name="guest" class="guest" placeholder="Total number of guest" autocomplete="on"
                    required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="Number" class="form-label">Check In Date</label>
                  <input type="date" name="date" class="date" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button name="submit" type="submit" class="main-button">Make Your Reservation Now</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include "includes/footer.php"; ?>

  <script>
    $(".option").click(function ( )  {
      $(".option").removeClass("active");
      $(this).addClass("active");    });
  </script>