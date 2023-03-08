<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/order.php');
    $classOrder = new order();
    if(isset($_GET['id'])) {
        $OrderID = $_GET['id'];
        $result_order = $classOrder->getByID($OrderID);
        foreach ($result_order as $order) {}
        $OrderStatus = $order['Status'];
        if ($OrderStatus == "Unprocessed") {
            $Unprocessed = "active step0";
            $Confirmed   = "step0";
            $Shipping    = "step0";
            $Shipped     = "step0";

        } else if ($OrderStatus == "Confirmed") {
            $Unprocessed = "active step0";
            $Confirmed   = "active step0";
            $Shipping    = "step0";
            $Shipped     = "step0";
        } else if ($OrderStatus == "Shipping") {
            $Unprocessed = "active step0";
            $Confirmed   = "active step0";
            $Shipping = "active step0";
            $Shipped     = "step0";
        } else if ($OrderStatus == "Shipped") {
            $Unprocessed = "active step0";
            $Confirmed   = "active step0";
            $Shipping = "active step0";
            $Shipped = "active step0";
        } else {
            $Unprocessed = "step0";
            $Confirmed   = "step0";
            $Shipping = "step0";
            $Shipped = "step0";
        }
    }
?>
<style>
body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color: #8C9EFF;
    background-repeat: no-repeat
}

.card {
    z-index: 0;
    background-color: #ECEFF1;
    padding-bottom: 20px;
    margin-top: 90px;
    margin-bottom: 90px;
    border-radius: 10px
}

.top {
    padding-top: 40px;
    padding-left: 13% !important;
    padding-right: 13% !important
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px
}

#progressbar li {
    list-style-type: none;
    font-size: 13px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar .step0:before {
    font-family: FontAwesome;
    content: "\f10c";
    color: #fff
}

#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    background: #C5CAE9;
    border-radius: 50%;
    margin: auto;
    padding: 0px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 12px;
    background: #C5CAE9;
    position: absolute;
    left: 0;
    top: 16px;
    z-index: -1
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%
}

#progressbar li:nth-child(2):after,
#progressbar li:nth-child(3):after {
    left: -50%
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    position: absolute;
    left: 50%
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #651FFF
}

#progressbar li.active:before {
    font-family: FontAwesome;
    content: "\f00c"
}

.icon {
    width: 60px;
    height: 60px;
    margin-right: 15px
}

.icon-content {
    padding-bottom: 20px
}

@media screen and (max-width: 992px) {
    .icon-content {
        width: 50%
    }
}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js ">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js	"></script>

<div class="container px-1 px-md-4 py-5 mx-auto">
    <div class="card">
        <div class="row d-flex justify-content-between px-3 top">
            <div class="d-flex">
                <h5>ORDER <span class="text-primary font-weight-bold">#<?php echo $order['OrderID'] ?></span></h5>
            </div>
            <div class="d-flex flex-column text-sm-right">
                <p class="mb-0">Expected Arrival <span class="font-weight-bold"><?php echo $order['ShipDate'] ?></span></p>
            </div>
        </div> <!-- Add class 'active' to progress -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <ul id="progressbar" class="text-center">
                    <li class="<?php echo $Unprocessed ?>"></li>
                    <li class="<?php echo $Confirmed ?>"></li>
                    <li class="<?php echo $Shipping ?>"></li>
                    <li class="<?php echo $Shipped ?>"></li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-between top">
            
            <div class="row d-flex icon-content"> <img class="icon" src="https://imgur.com/o1WbgVj.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Unprocessed</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Confirmed</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Shipping<br></p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Shipped</p>
                </div>
            </div>
        </div>
    </div>
    
</div>
