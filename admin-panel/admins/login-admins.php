<?php include '../../config/server.php'?>
<?php include '../includes/header.php'?>
<?php

if(isset($_POST['submit'])){
  if (empty($_POST['email']) || empty($_POST['password'])) {

    echo '<div class="alert alert-danger" role="alert">
  Input field cannot be empty!
</div>';

  } else {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkEmail = $conn->prepare("SELECT * FROM admins WHERE email = :email");
    $checkEmail->bindParam(':email', $email);
    $checkEmail->execute();

    if ($checkEmail->rowCount() == 0) {
      echo '<div class="alert alert-danger" role="alert">
    Invalid Email or password! Please check your credentials and try again.
  </div>';

    } else {

      $admin = $checkEmail->fetch(PDO::FETCH_ASSOC);
      if (password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['username'] = $admin['username'];
        $_SESSION['email'] = $email;

        header("location:" . ADMINURL . "");
      } else {
        echo '<div class="alert alert-danger" role="alert">
    Invalid Email or password! Please check your credentials and try again.
  </div>';
      }
    }
  }
}

?>
<div class="container-fluid"> 
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" class="p-auto" action="login-admins.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                 
                </form>

            </div>
       </div>
     </div>
    </div>
</div>
<?php include '../includes/footer.php'?>