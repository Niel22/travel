<?php include "includes/header.php"; ?>
<?php include "config/server.php"; ?>
<?php

if (isset($_POST['submit'])) {
    if (empty($_POST['destination']) || empty($_POST['price'])) {

        // header("location:".$_SERVER['HTTP_REFERER']."");
        echo "Error";

    } else {
        $country_id = $_POST['destination'];
        $price = $_POST['price'];

        $search = $conn->query("SELECT * FROM cities WHERE country_id = $country_id AND price <= $price");
        $search->execute();

        $allSearch = $search->fetchAll(PDO::FETCH_OBJ);
    }

}

?>
<!-- ***** Header Area End ***** -->

<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4>Search Result</h4>
                <h2>Amazing Prices &amp; More</h2>
            </div>
        </div>
    </div>
</div>

<div class="amazing-deals">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading text-center">
                    <h2>Best Weekly Offers In Each City</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore.</p>
                </div>
            </div>
            <?php if (count($allSearch) > 0): ?>
                <?php foreach ($allSearch as $result): ?>
                    <div class="col-lg-6 col-sm-6">
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="image">
                                        <img src="<?= APPURL ?>assets/images/<?= $result->image; ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 align-self-center">
                                    <div class="content">
                                        <span class="info">*Limited Offer Today</span>
                                        <h4>
                                            <?= $result->name; ?>
                                        </h4>
                                        <div class="row">
                                            <div class="col-6">
                                                <i class="fa fa-clock"></i>
                                                <span class="list">
                                                    <?= $result->trip_days; ?> Days
                                                </span>
                                            </div>
                                            <div class="col-6">
                                                <i class="fa fa-map"></i>
                                                <span class="list">Daily Places</span>
                                            </div>
                                        </div>
                                        <p>Limited Pice: $
                                            <?= $result->price; ?> per person
                                        </p>
                                        <div class="main-button">
                                            <a href="reservation.php?id=<?= $result->id; ?>">Make a Reservation</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <div class="alert alert-warning text-center"> No result for your search</div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php include "includes/footer.php"; ?>


<script>
    $(".option").click(function () {
        $(".option").removeClass("active");
        $(this).addClass("active");
    });
</script>