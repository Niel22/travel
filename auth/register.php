<?php include "../includes/header.php";?>
<?php include "../config/server.php";?>

<?php

if(isset($_SESSION['username'])){
  header("location:".APPURL."");
}

?>

  <div class="reservation-form">
<?php

if(isset($_POST['submit'])){

  if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) ){

    echo '<div class="alert alert-danger" role="alert">
    Input field cannot be empty!
  </div>';

  }else{

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $checkEmail->bindParam(':email', $email);
    $checkEmail->execute();

    if($checkEmail->rowCount() > 0){
      echo '<div class="alert alert-danger" role="alert">
      This email already exist!
    </div>';

    }else{

      $insert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
      $insert->bindParam(":username", $username);
      $insert->bindParam(":email", $email);
      $insert->bindParam(":password", $password);
      $insert->execute();

      if($insert){
        header("location:".APPURL."auth/login.php");
      }
    }
  }
}

?>
    <div class="container">
      <div class="row">
        
        <div class="col-lg-12">
          <form id="reservation-form" method="post" role="search" action="register.php">
            <div class="row">
              <div class="col-lg-12">
                <h4>Register</h4>
              </div>
              <div class="col-md-12">
                <fieldset>
                    <label for="Name" class="form-label">Username</label>
                    <input type="text" name="username" class="username" placeholder="username" autocomplete="on" required>
                </fieldset>
              </div>

              <div class="col-md-12">
                  <fieldset>
                      <label for="Name" class="form-label">Your Email</label>
                      <input type="email" name="email" class="email" placeholder="email" autocomplete="on" required>
                  </fieldset>
              </div>
           
              <div class="col-md-12">
                <fieldset>
                    <label for="Name" class="form-label">Your Password</label>
                    <input type="password" name="password" class="password" placeholder="password" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">                        
                  <fieldset>
                      <button type="name" name="submit" class="main-button">register</button>
                  </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include "../includes/footer.php";?>

  <script>
    $(".option").click(function(){
      $(".option").removeClass("active");
      $(this).addClass("active"); 
    });
  </script>