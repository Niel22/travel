<?php include '../../config/server.php' ?>
<?php include '../includes/header.php'?>
<?php

$countries = $conn->query("SELECT * FROM countries");
$countries->execute();

$AllCountries = $countries->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="container-fluid">

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Countries</h5>
             <a  href="create-country.php" class="btn btn-primary mb-4 text-center float-right">Create Country</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">continent</th>
                    <th scope="col">population</th>
                    <th scope="col">territory</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($AllCountries as $country): ?>
                  <tr>
                    <th scope="row"><?= $country->id?></th>
                    <td><?= $country->name?></td>
                    <td><?= $country->continent?></td>
                    <td><?= $country->population?></td>
                    <td><?= $country->territory?></td>
                    <td><a href="delete-country.php?id=<?= $country->id?>" class="btn btn-danger  text-center ">Delete</a></td>
                  </tr>
                <?php endforeach?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



  </div>
  <?php include '../includes/footer.php'?>
