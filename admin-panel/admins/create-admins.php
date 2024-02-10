<?php include '../../config/server.php'?>
<?php include '../includes/header.php'?>
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

    $checkEmail = $conn->prepare("SELECT * FROM admins WHERE email = :email");
    $checkEmail->bindParam(':email', $email);
    $checkEmail->execute();

    if($checkEmail->rowCount() > 0){
      echo '<div class="alert alert-danger" role="alert">
      This email already exist!
    </div>';

    }else{

      $insert = $conn->prepare("INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)");
      $insert->bindParam(":username", $username);
      $insert->bindParam(":email", $email);
      $insert->bindParam(":password", $password);
      $insert->execute();

      if($insert){
        header("location:".ADMINURL."admins/login-admins.php");
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
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  <?php include '../includes/footer.php'?>
