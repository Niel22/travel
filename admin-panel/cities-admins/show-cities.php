<?php include '../../config/server.php' ?>
<?php include '../includes/header.php'?>
<?php

$cities = $conn->query("SELECT * FROM cities");
$cities->execute();

$Allcities = $cities->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="container-fluid">

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Cities</h5>
              <a  href="create-cities.php" class="btn btn-primary mb-4 text-center float-right">Create cities</a>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">trip_days</th>
                    <th scope="col">price</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($Allcities as $city): ?>
                  <tr>
                    <th scope="row"><?= $city->id?></th>
                    <td><?= $city->name?></td>
                    <td><?= $city->trip_days?></td>
                    <td>$<?= $city->price?></td>
                     <td><a href="delete-posts.php?id=<?= $city->id?>" class="btn btn-danger  text-center ">delete</a></td>
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
