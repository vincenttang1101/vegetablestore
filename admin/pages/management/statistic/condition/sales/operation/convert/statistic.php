<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/carbon/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/order.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $classOrder = new order();
    if (!empty($_POST['Milestone']) && empty($_POST['FromDate']) && empty($_POST['ToDate'])) {
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
        $sql = "SELECT COUNT(DISTINCT orderdetails.OrderID) AS SumOrder, SUM(`Quantity`) AS `Quantity`, SUM(DISTINCT `Total`) AS `Revenue`, STR_TO_DATE(`OrderDate`,'%Y-%m-%d') AS `OrderDate`,`ShipDate`
                FROM `order`
                INNER JOIN `orderdetails`
                ON order.OrderID = orderdetails.OrderID
                WHERE `OrderDate`  BETWEEN '$from' AND  DATE_ADD('$to', INTERVAL +1 DAY) AND order.Status = 'Shipped'
                GROUP BY STR_TO_DATE(`OrderDate`, '%Y-%m-%d')";
        $result = $classOrder->executeResult($sql);
        if (is_array($result) || is_object($result)) {
            foreach ($result as $statistic) {
                $chart_data[] = array (
                    'SumOrder' => $statistic['SumOrder'],
                    'Quantity' => $statistic['Quantity'],
                    'Revenue'  => $statistic['Revenue'],
                    'OrderDate' => $statistic['OrderDate'],
                    'ShipDate' => $statistic['ShipDate']
                );
            }
        } else $chart_data = "0";
        echo $data = json_encode($chart_data);
    } else if(!empty($_POST['FromDate']) && !empty($_POST['ToDate']) && empty($_POST['Milestone'])) {
        $from = $_POST['FromDate'];
        $to = $_POST['ToDate'];
        $sql = "SELECT COUNT(DISTINCT orderdetails.OrderID) AS SumOrder, SUM(`Quantity`) AS `Quantity`, SUM(DISTINCT `Total`) AS `Revenue`, STR_TO_DATE(`OrderDate`,'%Y-%m-%d') AS `OrderDate`,`ShipDate`
                FROM `order`
                INNER JOIN `orderdetails`
                ON order.OrderID = orderdetails.OrderID
                WHERE `OrderDate`  BETWEEN '$from' AND  DATE_ADD('$to', INTERVAL +1 DAY) AND order.Status = 'Shipped'
                GROUP BY STR_TO_DATE(`OrderDate`, '%Y-%m-%d')";
        $result = $classOrder->executeResult($sql);
        if (is_array($result) || is_object($result)) {
            foreach ($result as $statistic) {
                $chart_data[] = array (
                    'SumOrder' => $statistic['SumOrder'],
                    'Quantity' => $statistic['Quantity'],
                    'Revenue'  => $statistic['Revenue'],
                    'OrderDate' => $statistic['OrderDate'],
                    'ShipDate' => $statistic['ShipDate']
                );
            }
        } else $chart_data = "0";
        echo $data = json_encode($chart_data);
    } else echo $chart_data="1";
    
?>