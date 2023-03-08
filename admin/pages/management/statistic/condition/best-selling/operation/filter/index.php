<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/carbon/autoload.php');
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $classVegetable = new vegetable();
    $output_vegetablelist = '';
    $from = '';
    $to = '';
    if (isset($_POST)) {
        if (!empty($_POST['FromDate']) && !empty($_POST['ToDate'] && empty($_POST['Milestone']))) {
            $from = $_POST['FromDate'];
            $to   = $_POST['ToDate'];
            $result_milestone = $classVegetable->bestSelling($from,$to);
            if (is_array($result_milestone) || is_object($result_milestone))  {
                $output_vegetablelist .=   '<table class="table table-hover table-bordered" style="text-align: center">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th>Vegetable ID</th>
                                                        <th>Vegetable Name</th>
                                                        <th>Category</th>
                                                        <th>Picture</th>
                                                        <th>Quantity Sold</th> 
                                                        <th>Unit</th>
                                                        <th>Selling Price</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="vegetable_list_tbody">';
                foreach ($result_milestone as $Vegetable) {
                    $output_vegetablelist .=        '<tr>    
                                                        <td>'.$Vegetable['VegetableID'].'</td>
                                                        <td>'.$Vegetable['VegetableName'].'</td>
                                                        <td>'.$Vegetable['CategoryName'].'</td>
                                                        <td><img src="'.$server_root.'/'.$Vegetable['Image'] .'"alt = "" width ="150px" class="img-fluid"></td>
                                                        <td>'.$Vegetable['Quantity'].'</td>
                                                        <td>'.$Vegetable['Unit'].'</td>
                                                        <td>'.number_format($Vegetable['Price']).' VND'.'</td>
                                                        <td>'.$Vegetable['OrderDate'].'</td>
                                                    </tr>';
                }
                $output_vegetablelist.=          '</tbody>
                                            </table>';
            } else $output_vegetablelist .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
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
            $result_milestone = $classVegetable->bestSelling($from,$to);    
            if (is_array($result_milestone) || is_object($result_milestone))  {
                $output_vegetablelist .=   '<table class="table table-hover table-bordered" style="text-align: center">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th>Vegetable ID</th>
                                                        <th>Vegetable Name</th>
                                                        <th>Category</th>
                                                        <th>Picture</th>
                                                        <th>Quantity Sold</th> 
                                                        <th>Unit</th>
                                                        <th>Selling Price</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="vegetable_list_tbody">';
                foreach ($result_milestone as $Vegetable) {
                    $output_vegetablelist .=        '<tr>    
                                                        <td>'.$Vegetable['VegetableID'].'</td>
                                                        <td>'.$Vegetable['VegetableName'].'</td>
                                                        <td>'.$Vegetable['CategoryName'].'</td>
                                                        <td><img src="'.$server_root.'/'.$Vegetable['Image'] .'"alt = "" width ="150px" class="img-fluid"></td>
                                                        <td>'.$Vegetable['Quantity'].'</td>
                                                        <td>'.$Vegetable['Unit'].'</td>
                                                        <td>'.number_format($Vegetable['Price']).' VND'.'</td>
                                                        <td>'.$Vegetable['OrderDate'].'</td>
                                                    </tr>';
                }
                $output_vegetablelist.=          '</tbody>
                                            </table>';
            } else $output_vegetablelist .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
        } else {
            $output_vegetablelist .= "<div class='alert alert-danger' id='alert-danger'>Please check the filter condition again</div>";
        }
    }
    echo $output_vegetablelist;
?>