<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/order.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/carbon/autoload.php');
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $classOrder = new order();
    $output_orderlist = '';
    $from = '';
    $to = '';
    if (isset($_POST)) {
        if (!empty($_POST['FromDate']) && !empty($_POST['ToDate'] && empty($_POST['Milestone']))) {
            $from = $_POST['FromDate'];
            $to   = $_POST['ToDate'];
            $result_milestone = $classOrder->RevenueByMileStone($from,$to);
            if (is_array($result_milestone) || is_object($result_milestone))  {
                $output_orderlist .= '<table class="table table-hover table-bordered" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Details</th>
                                                <th>Total Order</th>
                                                <th>Order Date</th>
                                                <th>Ship Date</th>
                                                <th>Revenue</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                $stt = 1;
                foreach ($result_milestone as $Order) {
                     $output_orderlist .=  '<tr>
                                                <td>'.$stt++.'</td>
                                                <td>
                                                    <a href="'.$server_root.'"> 
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </td>
                                                <td>'.$Order['TotalOrder'].'</td>
                                                <td>'.$Order['OrderDate'].'</td>
                                                <td>'.$Order['ShipDate'].'</td>
                                                <td>'.number_format($Order['Revenue']).' VND'.'</td>
                                                <td><span style="color:white; font-size:15px;" class="badge badge-success">'.$Order['Status'].'</span>
                                                    </a>
                                                </td>';
                        $output_orderlist .= '</tr>';              
                }
                $output_orderlist .=    '</tbody>
                                    </table>';
            } else $output_orderlist .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
        } else if (!empty($_POST['Milestone']) && empty($_POST['FromDate']) && empty($_POST['ToDate'])) {
            $time = $_POST['Milestone'];
            if ($time == "7 days" ) {
                $from = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
            } else if ($time == "28 days") {
                $from = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
            } else if ($time == "90 days") {
                $from = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
            } else if ($time == "365 days") {
                $from = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
            } 
            $to = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $result_milestone = $classOrder->RevenueByMileStone($from,$to);
            if (is_array($result_milestone) || is_object($result_milestone))  {
                $output_orderlist .= '<table class="table table-hover table-bordered" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Details</th>
                                                <th>Total Order</th>
                                                <th>Order Date</th>
                                                <th>Ship Date</th>
                                                <th>Revenue</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                $stt = 1;
                foreach ($result_milestone as $Order) {
                     $output_orderlist .=  '<tr>
                                                <td>'.$stt++.'</td>
                                                <td>
                                                    <a href="'.$server_root.'"> 
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </td>
                                                <td>'.$Order['TotalOrder'].'</td>
                                                <td>'.$Order['OrderDate'].'</td>
                                                <td>'.$Order['ShipDate'].'</td>
                                                <td>'.number_format($Order['Revenue']).' VND'.'</td>
                                                <td><span style="color:white; font-size:15px;" class="badge badge-success">'.$Order['Status'].'</span>
                                                    </a>
                                                </td>';
                        $output_orderlist .= '</tr>';              
                }
                $output_orderlist .=    '</tbody>
                                    </table>';
            } else $output_orderlist .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
        } else {
            $output_orderlist .= "<div class='alert alert-danger' id='alert-danger'>Please check the filter condition again</div>";
        }
    }
    echo $output_orderlist;
?>