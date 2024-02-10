<?php include "../includes/header.php"; ?>
<?php include "../config/server.php";?>
<?php

if(isset($_SESSION['user_id'])){
  header("location:".APPURL."");
}

?>


<div class="reservation-form">
  <?php

  if (isset($_POST['submit'])) {

    if (empty($_POST['email']) || empty($_POST['password'])) {

      echo '<div class="alert alert-danger" role="alert">
    Input field cannot be empty!
  </div>';

    } else {

      $email = $_POST['email'];
      $password = $_POST['password'];

      $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = :email");
      $checkEmail->bindParam(':email', $email);
      $checkEmail->execute();

      if ($checkEmail->rowCount() == 0) {
        echo '<div class="alert alert-danger" role="alert">
      Invalid Email or password! Please check your credentials and try again.
    </div>';

      } else {

        $user = $checkEmail->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])) {
          $_SESSION['user_id'] = $user['user_id'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['email'] = $email;

          header("location:" . APPURL . "");
        } else {
          echo '<div class="alert alert-danger" role="alert">
      Invalid Email or password! Please check your credentials and try again.
    </div>';
        }
      }
    }
  }

  ?>
  <div class="container">
    <div class="row">

      <div class="col-lg-12">
        <form id="reservation-form" method="post" role="search" action="login.php">
          <div class="row">
            <div class="col-lg-12">
              <h4>Login</h4>
            </div>
            <div class="col-md-12">
              <fieldset>
                <label for="Name" class="form-label">Your Email</label>
                <input type="email" name="email" class="Name" placeholder="email" autocomplete="on" required>
              </fieldset>
            </div>
            <!-- <div class="col-lg-6">
                <fieldset>
                    <label for="Number" class="form-label">Your Phone Number</label>
                    <input type="text" name="Number" class="Number" placeholder="Ex. +xxx xxx xxx" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                  <fieldset>
                      <label for="chooseGuests" class="form-label">Number Of Guests</label>
                      <select name="Guests" class="form-select" aria-label="Default select example" id="chooseGuests" onChange="this.form.click()">
                          <option selected>ex. 3 or 4 or 5</option>
                          <option type="checkbox" name="option1" value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4+">4+</option>
                      </select>
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
                      <label for="chooseDestination" class="form-label">Choose Your Destination</label>
                      <select name="Destination" class="form-select" aria-label="Default select example" id="chooseCategory" onChange="this.form.click()">
                          <option selected>ex. Switzerland, Lausanne</option>
                          <option value="Italy, Roma">Italy, Roma</option>
                          <option value="France, Paris">France, Paris</option>
                          <option value="Engaland, London">Engaland, London</option>
                          <option value="Switzerland, Lausanne">Switzerland, Lausanne</option>
                      </select>
                  </fieldset>
              </div> -->

            <div class="col-md-12">
              <fieldset>
                <label for="Name" class="form-label">Your Password</label>
                <input type="password" name="password" class="Name" placeholder="password" autocomplete="on" required>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <button name="submit" type="submit" class="main-button">login</button>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "../includes/footer.php"; ?>


<script>
  $(".option").click(function () {
    $(".option").removeClass("active");
    $(this).addClass("active");
  });
</script>