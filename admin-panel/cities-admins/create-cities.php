<?php include '../../config/server.php' ?>
<?php include '../includes/header.php' ?>
<?php
if (isset($_POST["submit"])) {
  if (empty($_POST["name"]) || empty($_FILES["image"]) || empty($_POST["trip_days"]) || empty($_POST["price"]) || empty($_POST["country"])) {
    echo "Empty fild detected";
  } else {
    function val($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $name = val($_POST["name"]);
    $image = $_FILES["image"];
    $trip_days = val($_POST["trip_days"]);
    $price = $_POST["price"];
    $country = val($_POST["country"]);

    $imageName = $image['name'];
    $imageTempName = $image['tmp_name'];

    $imageDiv = explode('.', $imageName);
    $imageExt = strtolower(end($imageDiv));

    $extList = array('jpeg', 'jpg', 'png');
    if (in_array($imageExt, $extList)) {
      $imageUrl = $name . '.' . $imageExt;
      $imagePath = "../../assets/images/" . $imageUrl;
      $movedImage = move_uploaded_file($imageTempName, $imagePath);
      if ($movedImage) {
        $insert = $conn->prepare("INSERT INTO cities (name, image, trip_days, price, country_id) VALUES (:name, :image, :trip_days, :price, :country)");
        $insert->execute([
          ':name' => $name,
          ':image' => $imageUrl,
          ':trip_days' => $trip_days,
          ':price' => $price,
          ':country' => $country
        ]);

        if ($insert) {
          header("location:" . ADMINURL . "cities-admins/show-cities.php");
        } else {
          header("location:" . ADMINURL . "cities-admins/create-cities.php");
        }
      } else {
        header("location:" . ADMINURL . "");
      }
    }
  }


}

//grabbing countries
$countries = $conn->query("SELECT * FROM countries");
$countries->execute();

$allCountries = $countries->fetchAll(PDO::FETCH_OBJ);

?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Cities</h5>
          <form method="POST" action="" enctype="multipart/form-data">
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />

            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="file" name="image" id="form2Example1" class="form-control" />

            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="trip_days" id="form2Example1" class="form-control" placeholder="trip_days" />

            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />

            </div>
            <div class="form-outline mb-4 mt-4">

              <select name="country" class="form-select  form-control" aria-label="Default select example">
                <option selected>Choose Country</option>
                <?php foreach ($allCountries as $country): ?>
                  <option value="<?= $country->id; ?>">
                    <?= $country->name; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <br>



            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../includes/footer.php' ?>