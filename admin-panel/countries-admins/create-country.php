<?php include '../../config/server.php' ?>
<?php include '../includes/header.php' ?>
<?php
if (isset($_POST["submit"])) {
  if (empty($_POST["name"]) || empty($_POST["description"]) || empty($_FILES["image"]) || empty($_POST["continent"]) || empty($_POST["population"]) || empty($_POST["territory"])) {
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
    $continent = val($_POST["continent"]);
    $population = $_POST["population"];
    $description = val($_POST["description"]);
    $territory = val($_POST["territory"]);
    $image = $_FILES["image"];

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
        $insert = $conn->prepare("INSERT INTO countries (name, description, images, continent, population, territory) VALUES (:name, :description, :image, :continent, :population, :territory)");
        $insert->execute([
          ':name' => $name,
          ':description' => $description,
          ':image' => $imageUrl,
          ':continent' => $continent,
          ':population' => $population,
          ':territory' => $territory
        ]);

        if ($insert) {
          header("location:" . ADMINURL . "countries-admins/show-country.php");
        } else {
          header("location:" . ADMINURL . "countries-admins/create-country.php");
        }
      } else {
        header("location:" . ADMINURL . "");
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
          <h5 class="card-title mb-5 d-inline">Create Countries</h5>
          <form method="POST" action="" enctype="multipart/form-data">
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />

            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="file" name="image" id="form2Example1" class="form-control" />

            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="continent" id="form2Example1" class="form-control" placeholder="continent" />

            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="population" id="form2Example1" class="form-control" placeholder="population" />

            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="territory" id="form2Example1" class="form-control" placeholder="territory" />

            </div>
            <div class="form-floating">
              <textarea name="description" class="form-control" placeholder="description" id="floatingTextarea2"
                style="height: 100px"></textarea>
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