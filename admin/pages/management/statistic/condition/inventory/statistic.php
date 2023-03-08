<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/carbon/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $classVgt = new vegetable();
    $sql = "SELECT * FROM `vegetable` WHERE Amount > 0 ORDER BY `VegetableID` ASC";
    $result = $classVgt->executeResult($sql);
    if (is_array($result) || is_object($result)) {
        foreach ($result as $statistic) {
             $chart_data[] = array (
                'VegetableName' => $statistic['VegetableName'],
                'Quantity' => $statistic['Amount'],
                'Price'  => $statistic['Price'],
            );
        }
    }
    echo $data = json_encode($chart_data);
?>