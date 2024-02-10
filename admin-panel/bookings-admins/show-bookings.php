<?php include '../../config/server.php' ?>
<?php include '../includes/header.php' ?>
<?php

$bookings = $conn->query("SELECT * FROM bookings");
$bookings->execute();

$AllBookings = $bookings->fetchAll(PDO::FETCH_OBJ);

?>
<div class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Bookings</h5>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">phone_number</th>
                <th scope="col">num_of_geusts</th>
                <th scope="col">checkin_date</th>
                <th scope="col">destination</th>
                <th scope="col">payment</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($AllBookings as $booking): ?>
                <tr>
                  <th scope="row">
                    <?= $booking->id; ?>
                  </th>
                  <td>
                    <?= $booking->name; ?>
                  </td>
                  <td>
                    <?= $booking->phone_number; ?>
                  </td>
                  <td>
                    <?= $booking->num_guests; ?>
                  </td>
                  <?php $dateString = "$booking->checkin_date"; // Replace this with your actual date and time string
                  
                    $dateTime = new DateTime($dateString);
                    $formattedDate = $dateTime->format('D, M j, Y g:i A');
                    ?>
                  <td>
                    <?= $formattedDate; ?>
                  </td>
                  <td><?= $booking->destination; ?></td>
                  <td>$<?= $booking->payment; ?></td>
                  <?php if($booking->status == "pending") :?>
                  <td><a href="status.php?id=<?= $booking->id;?>&status=<?= $booking->status?>" class="btn btn-danger  text-center ">Pending</a></td>
                  <?php else:?>
                    <td><a href="status.php?id=<?= $booking->id;?>&status=<?= $booking->status?>" class="btn btn-success  text-center ">Booked Successfully</a></td>
                </tr>
                <?php endif;?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>



</div>
<?php include '../includes/footer.php' ?>