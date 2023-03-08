<?php
session_start();
$server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
if (isset($_POST['VegetableID'])) {
    $VegetableID = $_POST['VegetableID'];
    $Quantity = (isset($_POST['update_quantity'])) ? $_POST['update_quantity'] : 1; 
    $action = (isset($_POST['action'])) ? $_POST['action'] :'Add';
    $classVegetable = new vegetable();

    $result = $classVegetable->getByID($VegetableID);
    if ($result){
        foreach($result as $product){   
            $Subtotal = (isset($_POST['subtotal'])) ? $_POST['subtotal']* $Quantity : $Quantity * $product['Price'];
            $item = [
                'VegetableID'=> $product['VegetableID'],
                'VegetableName'=> $product['VegetableName'],
                'Amount'=> $product['Amount'],
                'Unit'=> $product['Unit'],
                'Image'=> $product['Image'],
                'Price'=> $product['Price'],
                'Quantity'=> $Quantity,
                'Subtotal'=> $Subtotal
            ];
        }
    }
    if ($action == "Add") {
        if (isset($_SESSION['cart'][$VegetableID]) && $_SESSION['cart'][$VegetableID]['Quantity'] < $_SESSION['cart'][$VegetableID]['Amount']) {
            $_SESSION['cart'][$VegetableID]['Quantity'] += $Quantity;
            $_SESSION['cart'][$VegetableID]['Subtotal'] += $Quantity * $_SESSION['cart'][$VegetableID]['Price'];        
        } else if (isset($_SESSION['cart'][$VegetableID]) && $_SESSION['cart'][$VegetableID]['Quantity'] == $_SESSION['cart'][$VegetableID]['Amount']) {
            echo '<script>alert("This '. $_SESSION['cart'][$VegetableID]['VegetableName'] .' is out of stock !")</script>';
        }
        else {
            $_SESSION['cart'][$VegetableID] = $item;
            if($Quantity > $_SESSION['cart'][$VegetableID]['Amount']) {
                echo '<script>alert("This '. $_SESSION['cart'][$VegetableID]['VegetableName'] .' is out of stock !")</script>';
                unset($_SESSION['cart'][$VegetableID]);
            }
        }
    }
    if ($action == "Update") {
        if ($Quantity > $_SESSION['cart'][$VegetableID]['Amount']) {
            echo '<script>alert("This '. $_SESSION['cart'][$VegetableID]['VegetableName'] .' is out of stock !")</script>';
        }  else {
            $_SESSION['cart'][$VegetableID]['Quantity'] = $Quantity;
            $_SESSION['cart'][$VegetableID]['Subtotal'] = $Subtotal;
        }
    }

    if ($action == "Delete") {
        unset($_SESSION['cart'][$VegetableID]);
    }
    $cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
    //var_dump($cart);
    //echo "<pre>";
}

?>

<html>
<head>
    <title>Cart</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
    .btn.btn-success {
        background-color: #48b83e;
        color: #fff;
        border: 1px solid #008000;
        border-radius: 10px;
        font-weight: 800;
    }

    .btn.btn-success:hover {
        background-color: #48b83ee8;
    }
    #remove {
        padding: 0;
        border: none;
        background: none;
    }
    </style>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php require_once('../menu.php') ?>
    <div class ="container">
        <div class ="row">
            <div class ="col-md-2"></div>
            <div class ="col-md-10">
                <div class ="panel-body">
                    <table class="table table-hover" style="text-align: center">
                    <h2>Cart</h2>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Picture</th>
                                <th>Unit</kg>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_price = 0; $stt = 1; $total_Quantity = 0; 
                            foreach ($cart as $value):    
                                $total_price += ($value['Price'] * $value['Quantity']);   
                                $total_Quantity += $value['Quantity'];
                            ?>
                                <tr>
                                    <td><?php echo $stt++?></td>
                                    <td><?php echo $value['VegetableName']; ?></td>
                                    <td><img src ="../<?php echo $value['Image']; ?>" alt = "" width ="150px"/></td>  
                                    <td><?php echo $value['Unit'] ?></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="action" value="Update">
                                            <input type="hidden" name="VegetableID" value="<?php echo $value['VegetableID'] ?>">
                                            <input type="number" name="update_quantity" value="<?php echo $value['Quantity'] ?>">
                                            <input type="hidden" name="subtotal" value="<?php echo $value['Price']?>">
                                            <button type="submit" class="pt-1"><i class="fa fa-refresh"></i></button>
                                        </form>
                                    </td>
                                    <td><?php echo number_format($value['Price']) ?></td>
                                    <td><?php echo number_format($value['Price'] * $value['Quantity']) ?></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="action" value="Delete">
                                            <input type="hidden" name="VegetableID" value="<?php echo $value['VegetableID'] ?>">
                                            <button id="remove" type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-remove" style="font-size:24px"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                                  $_SESSION['stt'] = $stt - 1;
                                  $_SESSION['count_price'] = $total_price;
                                  $_SESSION['count_quantity'] = $total_Quantity;
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-weight: bold">Total:</td>
                                <td><?php echo number_format($total_Quantity)?></td>
                                <td></td>
                                <td><?php echo number_format($total_price).' VND'?></td>
                            </tr>
                        </tbody>
                    </table>
                    <form method ="post" action="order.php">
                        <input type ="submit" name ="Order" class="btn btn-success float-right" value ="Order">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
