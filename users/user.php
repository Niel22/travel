<?php include "../includes/header.php"; ?>
<?php include "../config/server.php"; ?>
<?php

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $user_bookings = $conn->query("SELECT * FROM bookings WHERE user_id = $_GET[id]");
    $user_bookings->execute();

    $Alluser_booking = $user_bookings->fetchAll(PDO::FETCH_OBJ);
}else{
    header("location: 404.php");
}

?>
<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-12">
            <?php if(count($Alluser_booking) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Number Of Guest</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Checkin Date</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Status</th>
                        <th scope="col">Payment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Alluser_booking as $user_booking): ?>
                        <tr>
                            <td>
                                <?= $user_booking->name; ?>
                            </td>
                            <td>
                                <?= $user_booking->num_guests; ?>
                            </td>
                            <td>
                                <?= $user_booking->phone_number; ?>
                            </td>
                            <?php $dateString = "$user_booking->checkin_date"; // Replace this with your actual date and time string
                            
                                $dateTime = new DateTime($dateString);
                                $formattedDate = $dateTime->format('D, M j, Y g:i A'); 
                            ?>
                            <td>
                                <?= $formattedDate; ?>
                            </td>
                            <td>
                                <?= $user_booking->destination; ?>
                            </td>
                            <td>
                                <?= $user_booking->status; ?>
                            </td>
                            <td>
                                $<?= $user_booking->payment; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else:?>
                <div class="alert alert-success mt-5 text-white"> No Bookngs Yet</div>
            <?php endif;?>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>