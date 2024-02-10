<?php include "includes/header.php"; ?>
<?php include "config/server.php"; ?>
<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    header("location:".APPURL."");
    exit;
}

?>
    <div class="container">  
                    <!-- Replace "test" with your own sandbox Business account app client ID -->
                    <script src="https://www.paypal.com/sdk/js?client-id=Aa9_OzmcXaQDInsv21InAs7sLLg0xGU3Dms5P2WuMu677xpFnUXRCYmLdoOkmUcS3Q1Gg0ucfF5ehplA&currency=USD"></script>
                    <!-- Set up a container element for the button -->
                    <div style="margin-top: 100px" id="paypal-button-container"></div>
                    <script>
                        paypal.Buttons({
                        // Sets up the transaction when a payment button is clicked
                        createOrder: (data, actions) => {
                            return actions.order.create({
                            purchase_units: [{
                                amount: {
                                value: "<?= $_SESSION['payment']; ?>" // Can also reference a variable or function
                                }
                            }]
                            });
                        },
                        // Finalize the transaction after payer approval
                        onApprove: (data, actions) => {
                            return actions.order.capture().then(function(orderData) {
                          
                             window.location.href='<?= APPURL;?>';
                            });
                        }
                        }).render('#paypal-button-container');
                    </script>
                  
                </div>
            </div>
        </div>

        <?php include "includes/footer.php";?>