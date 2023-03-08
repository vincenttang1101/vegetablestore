<?php
session_start();
$server_root = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . '/vegetablestore';
require_once($_SERVER['DOCUMENT_ROOT'] . '/vegetablestore/class/customer.php');
if (isset($_SESSION['yourID'])) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=VND&from=USD&amount=1",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: uEBtougjkUDqFyQ3j4pEJrnEoiRL4zxc"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $prices_usd = json_decode($response);
    //var_dump($prices_usd);
    $_price_USD = $prices_usd->result;
?>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(0, 0, 34);
            font-size: 0.8rem
        }

        .card {
            max-width: 1000px;
            margin: 2vh
        }

        .card-top {
            padding: 0.7rem 5rem
        }

        .card-top a {
            float: left;
            margin-top: 0.7rem
        }

        #logo {
            font-family: 'Dancing Script';
            font-weight: bold;
            font-size: 1.6rem
        }

        .card-body {
            padding: 0 5rem 5rem 5rem;
            background-image: url("https://i.imgur.com/4bg1e6u.jpg");
            background-size: cover;
            background-repeat: no-repeat
        }

        @media(max-width:768px) {
            .card-body {
                padding: 0 1rem 1rem 1rem;
                background-image: url("https://i.imgur.com/4bg1e6u.jpg");
                background-size: cover;
                background-repeat: no-repeat
            }

            .card-top {
                padding: 0.7rem 1rem
            }
        }

        .row {
            margin: 0
        }

        .upper {
            padding: 1rem 0;
            justify-content: space-evenly
        }

        #three {
            border-radius: 1rem;
            width: 22px;
            height: 22px;
            margin-right: 3px;
            border: 1px solid blue;
            text-align: center;
            display: inline-block
        }

        #payment {
            margin: 0;
            color: blue
        }

        .icons {
            margin-left: auto
        }

        form span {
            color: rgb(179, 179, 179)
        }

        form {
            padding: 2vh 0
        }

        input {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247)
        }

        input:focus::-webkit-input-placeholder {
            color: transparent
        }

        .header {
            font-size: 1.5rem
        }

        .left {
            background-color: #ffffff;
            padding: 2vh
        }

        .left img {
            width: 2rem
        }

        .left .col-4 {
            padding-left: 0
        }

        .right .item {
            padding: 0.3rem 0
        }

        .right {
            background-color: #ffffff;
            padding: 2vh
        }

        .col-8 {
            padding: 0 1vh
        }

        .lower {
            line-height: 2
        }

        .btn {
            background-color: rgb(23, 4, 189);
            border-color: rgb(23, 4, 189);
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin: 4vh 0 1.5vh 0;
            padding: 1.5vh;
            border-radius: 0
        }

        .btn:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            -webkit-user-select: none;
            transition: none
        }

        .btn:hover {
            color: white
        }

        a {
            color: black
        }

        a:hover {
            color: black;
            text-decoration: none
        }

        input[type=checkbox] {
            width: unset;
            margin-bottom: unset
        }

        #cvv {
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.575), rgba(255, 255, 255, 0.541)), url("https://img.icons8.com/material-outlined/24/000000/help.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center
        }

        #cvv:hover {}

        .btn.btn-primary {
            color: #fff;
            border: 1px solid #008000;
            border-radius: 10px;
            font-weight: 800
        }

        .btn.btn-warning {
            color: #fff;
            border: 1px solid #008000;
            border-radius: 10px;
            font-weight: 800
        }

        .btn.btn-danger {
            color: #fff;
            border: 1px solid #008000;
            border-radius: 10px;
            font-weight: 800
        }

        .btn.btn-success {
            color: #fff;
            border: 1px solid #008000;
            border-radius: 10px;
            font-weight: 800;
        }

        #paypal-button-container {
            margin-top: 10px;

        }
    </style>
    <?php $classCustomer = new customer(); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div style="margin-right: 50px; border-style: dotted">
        <table class="table table-hover">
            <strong>Currently the system only supports shipping within Ho Chi Minh City</strong>
            <thead>
                <tr>

                    <th>Province</th>
                    <th>District</th>
                    <th>Shipping Fee</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result_shipfee = $classCustomer->executeResult('SELECT * FROM ((`ship`
                                                                 INNER JOIN `provinces` ON ship.provinces_id = provinces.provinces_id)
                                                                 INNER JOIN `districts` ON ship.districts_id = districts.districts_id)');
                foreach ($result_shipfee as $shipfee) :
                ?>
                    <tr>
                        <td><?php echo $shipfee['provinces_name'] ?></td>
                        <td><?php echo $shipfee['districts_name'] ?></td>
                        <td><?php echo number_format($shipfee['ship_fee']) . ' VND'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="card-top border-bottom text-center"> <a href="<?php echo $server_root . '/vegetable/index.php' ?>"> Back to shop</a> <span id="logo">Payment Information</span> </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="left border">
                        <div class="row"> <span class="header">Payments</span>
                            <div class="icons"> <img src="https://img.icons8.com/fluency/48/000000/cash.png" /> <img src="https://img.icons8.com/fluency/48/000000/paypal.png" /></div>
                        </div>
                        <div class="float-right"><a href="../customer/user/index.php">Edit address information</a></div>
                        <form method="POST" action="saveorder.php" id="submit_form">
                            <span>Full name:</span> <input type="text" class="form-control" value="<?php echo $_SESSION['Fullname'] ?>" readonly>
                            <div class="row">
                                <div class="col-7"><span>Email:</span> <input type="email" class="form-control" value="<?php echo $_SESSION['Email'] ?>" required readonly></div>
                                <div class="col-5"><span>Phone:</span> <input type="number" class="form-control" value="<?php echo $_SESSION['Phone'] ?>" required readonly> </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <span>Address:</span>
                                    <input type="text" class="form-control" name="Address" value="<?php echo $_SESSION['Address'] ?>">
                                </div>

                                <div class="col-12" id="test_a">
                                    <span>Payment Methods:</span>
                                    <select id="payments" name="Payments" class="form-control" onchange="update_pay()">
                                        <option value="Cash">Pay with Cash</option>
                                        <option value="PayPal">PayPal</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <span>Note:</span>
                                    <textarea name="Note" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="right border">
                        <div class="header">Order Summary</div>
                        <p><?php echo $_SESSION['stt'] . ' items' ?></p>
                        <?php
                        $server_root = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . '/vegetablestore';
                        foreach ($_SESSION['cart'] as $product) {
                            echo '<div class="row item">
                                    <div class="col-4 align-self-center"><img class="img-fluid" src="' . $server_root . '/' . $product['Image'] . '"></div>
                                    <div class="col-8">
                                        <div class="row"><b>' . number_format($product['Price']) . ' VND</b></div>
                                        <div class="row text-muted">' . $product['VegetableName'] . '</div>
                                        <div class="row">Quantity: ' . $product['Quantity'] . '</div>
                                    </div>
                                </div>';
                        }
                        ?>

                        <hr>
                        <div class="row lower">
                            <div class="col text-left">Subtotal</div>
                            <div class="col text-right"><?php echo number_format($_SESSION['count_price']) ?></div>
                        </div>
                        <div class="row lower">
                            <div class="col text-left">Delivery</div>
                            <?php
                            $result_customer = $classCustomer->getByID($_SESSION['yourID']);
                            foreach ($result_customer as $customer) {
                                $provinces_id = $customer['provinces_id'];
                                $districts_id = $customer['districts_id'];
                                $result_ship = $classCustomer->executeResult("SELECT * FROM `ship` WHERE `provinces_id` = '$provinces_id' AND `districts_id` = '$districts_id'");
                                foreach ($result_ship as $ship) {
                            ?>
                                    <div class="col text-right"><?php echo number_format($ship['ship_fee']); ?></div>
                        </div>
                        <div class="row lower">
                            <div class="col text-left"><b>Total to pay</b></div>
                            <div class="col text-right"><b><?php echo number_format($_SESSION['count_price'] + $ship['ship_fee']) . ' VND' ?></b></div>
                            <input id="total_to_pay" type="hidden" value="<?php echo round(($_SESSION['count_price'] + $ship['ship_fee']) / $_price_USD, 2) ?>">
                            <input name="total_to_pay" type="hidden" value="<?php echo $_SESSION['count_price'] + $ship['ship_fee'] ?>">
                    <?php }
                            } ?>

                        </div>
                        <div class="row lower">
                        </div> <button type="submit" class="btn btn-success" id="pay_now">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AeuIUwBHlEuaVaasrrz-VkD7oTenzDX4cDWKHwg-ygNRtAv3vdeNluMgDNSNMkRR5WMzHUY_F5GFv5hB&currency=USD"></script>
    <script>
        function update_pay() {
            var select = document.getElementById('payments');
            var option = select.options[select.selectedIndex].value;
            var total_to_pay = document.getElementById('total_to_pay').value;
            if (option == "PayPal") {
                document.getElementById('pay_now').disabled = true;
                div_paypal = document.createElement('div');
                div_paypal.setAttribute('id', 'paypal-button-container');
                document.getElementById('test_a').appendChild(div_paypal);
                paypal.Buttons({
                    // Sets up the transaction when a payment button is clicked
                    createOrder: (data, actions) => {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: total_to_pay // Can also reference a variable or function
                                }
                            }]
                        });
                    },
                    // Finalize the transaction after payer approval
                    onApprove: (data, actions) => {
                        return actions.order.capture().then(function(orderData) {
                            // Successful capture! For dev/demo purposes:
                            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                            const transaction = orderData.purchase_units[0].payments.captures[0];
                            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                            document.getElementById('submit_form').submit();
                            // When ready to go live, remove the alert and show a success message within this page. For example:
                            // const element = document.getElementById('paypal-button-container');
                            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                            // Or go to another URL:  actions.redirect('thank_you.html');
                        });
                    },
                    onCancle: function(data) {
                        window.location.replace('<?php echo $server_root . '/cart/pay.php' ?>');
                    }
                }).render('#paypal-button-container');
            } else {
                document.getElementById('pay_now').disabled = false;
                document.getElementById('paypal-button-container').remove();
            }

        }
    </script>
<?php
} else {
    echo "<script>alert('You need to login before ordering !')
            window.location ='../customer/login.php'</script>";
}
?>