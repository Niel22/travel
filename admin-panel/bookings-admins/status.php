<?php include '../../config/server.php' ?>
<?php include '../includes/header.php' ?>
<?php

if(isset($_GET['id']) && isset($_GET['status'])){
    if($_GET['status'] == 'pending'){
        $approve = $conn->query("UPDATE bookings SET status = 'booked successfully' ");
        $approve->execute();

        header("location:".$_SERVER['HTTP_REFERER']."");
    }else{
        $pend = $conn->query("UPDATE bookings SET status = 'pending' ");
        $pend->execute();

        header("location:".$_SERVER['HTTP_REFERER']."");
    }
}
?>
<?php include '../includes/footer.php' ?>