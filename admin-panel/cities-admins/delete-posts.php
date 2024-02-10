<?php include '../../config/server.php' ?>
<?php include '../includes/header.php'?>
<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $delete = $conn->query("DELETE FROM cities WHERE id = $id");
    $delete->execute();

    header("location:".$_SERVER['HTTP_REFERER']."");
}

?>
  <?php include '../includes/footer.php'?>