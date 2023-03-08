<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/order.php');
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
    $classOrder = new order();
    if (isset($_POST['OrderID'])) {
        $OrderID = $_POST['OrderID'];
        $output_orderlist = '';
        $result_orderid = $classOrder->getByID($OrderID);
        foreach ($result_orderid as $Order) {
            if ($Order['Status'] == 'Unprocessed') {
                $execute_status = $classOrder->setStatus('Confirmed',$OrderID);
            } else if ($Order['Status'] == "Confirmed") {
                $execute_status = $classOrder->setStatus('Shipping',$OrderID);
            } else if ($Order['Status'] == "Shipping") {
                $execute_status = $classOrder->setStatus("Shipped",$OrderID);
            } else if ($Order['Status'] == "Shipped") {
                $execute_status = $classOrder->setStatus("Unprocessed",$OrderID);
            }
        }
        if ($execute_status) {
            $message = "The Order has been successfully updated status";
            $output_orderlist .= "<div class='alert alert-success' id='alert-success'>".$message."</div>";
            $output_orderlist .= '<table class="table table-hover table-bordered" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Details</th>
                                                    <th style="width: 7%">Order ID</th>
                                                    <th>Customer</th>
                                                    <th>Phone</th>
                                                    <th style="width:9%">Order Date</th>
                                                    <th style="width: 8%">Ship Date</th>
                                                    <th>Ship Place</th>
                                                    <th>Payments</th>
                                                    <th>Total</th>
                                                    <th>Note</th>
                                                    <th>Status</th>
                                                    <th style="width: 7%"></th>
                                                </tr>
                                            </thead>
                                        <tbody>';
            $result_orderlist = $classOrder->getAll();     
            if (is_array($result_orderlist) || is_object($result_orderlist)) {
                foreach ($result_orderlist as $Order) {
                    $output_orderlist .=       '<tr>
                                                    <td>
                                                        <a href="'.$server_root.'/admin/pages/management/order/list/operation/details/orderDetails.php?id='.$Order['OrderID'].'"> 
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>
                                                    </td>
                                                    <td>'.$Order['OrderID'].'</td>
                                                    <td>'.$Order['Fullname'].'</td>
                                                    <td>'.$Order['Phone'].'</td>
                                                    <td>'.$Order['OrderDate'].'</td>
                                                    <td>'.$Order['ShipDate'].'</td>
                                                    <td>'.$Order['ShipPlace'].'</td>
                                                    <td>';
                                                    if ($Order['Payments'] == "PayPal") {
                                                        $checkPay = "fab fa-cc-paypal";
                                                    } else $checkPay = "fas fa-money-bill-wave";     
                    $output_orderlist .=                '<i class="'.$checkPay.'"></i>
                                                    </td>
                                                    <td>'.number_format($Order['Total']).' VND'.'</td>
                                                    <td>'.$Order['Note'].'</td>
                                                    <td>
                                                        <a href="" class="update_status_a" id="'.$Order['OrderID'].'">';
                                                        if ($Order['Status'] == "Unprocessed") {
                                                            $classStatus = "badge badge-warning";
                                                        } else if ($Order['Status'] == "Confirmed") {
                                                            $classStatus = "badge badge-primary";
                                                        } else if ($Order['Status'] == "Shipping") {
                                                            $classStatus = "badge badge-info";
                                                        } else if ($Order['Status'] == "Shipped") {
                                                            $classStatus = "badge badge-success";
                                                        } else  if ($Order['Status'] == "Cancelled") {
                                                            $classStatus = "badge badge-danger";
                                                        }
                    $output_orderlist .=                    '<span style="color:white; font-size:15px;" class="'.$classStatus.'">'.$Order['Status'].'</span>
                                                        </a>
                                                    </td>
                                                    <td>';
                                                    if ($Order['Status'] != "Cancelled") {
                    $output_orderlist .=                '<a href="" class="update_order_a" id="'.$Order['OrderID'].'">
                                                            <i class="fas fa-edit"></i>
                                                        </a>';
                                                    }
                    $output_orderlist .=                '<a href="" class="print_order_a" id="'.$Order['OrderID'].'">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                        <a href="" class="delete_order_a" id="'.$Order['OrderID'].'">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <div id="'.$Order['OrderID'].'" style="display: none">
                                                    <h4>Receipt</h4>
                                                        Order ID: '.$Order['OrderID'].'<br>
                                                        Full Name: '.$Order['Fullname'].'<br>
                                                        Phone: '.$Order['Phone'].'<br>
                                                        Address: '.$Order['ShipPlace'].'<br>
                                                        Order Date: '.$Order['OrderDate'].'<br>
                                                        Ship Date: '.$Order['ShipDate'].'<br>
                                                        Payment: '.$Order['Payments'].'<br>
                                                        Total: '.$Order['Total'].'<br>
                                                    <h4> Order Details</h4>';
                                                    $result_orderdetails = $classOrder->getOrderDetails($Order['OrderID']);
                                                    foreach ($result_orderdetails as $orderdetails) {
                    $output_orderlist .=                '&nbsp Vegetable ID: '.$orderdetails['VegetableID'].'
                                                         &nbsp Vegetable Name: '.$orderdetails['VegetableName'].'
                                                         &nbsp Unit: '.$orderdetails['Unit'].'
                                                         &nbsp Quantity: '.$orderdetails['Quantity'].'
                                                         &nbsp Price: '.$orderdetails['Price'].'
                                                         &nbsp Subtotal: '.number_format($orderdetails['Subtotal']).' VND<br>';
                                                    }                                                  

                    $output_orderlist .=       '</div>';                
                } 
                $output_orderlist.= '</tbody>
                                </table>';
            } else $output_orderlist .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
        } else {
            $output_orderlist .= "<div class='alert alert-danger' id='alert-danger'>The Order has been unsuccessfully updated status</div>";
        }
        echo $output_orderlist;
    }


?>