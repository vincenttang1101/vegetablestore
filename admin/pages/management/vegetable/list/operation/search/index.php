<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
    $classVegetable = new vegetable();
    if (isset($_POST['keywords'])) {
        $keywords = $_POST['keywords'];
        $output_vegetablelist = '';
        $result_searchvegetablename = $classVegetable->searchVegetableName($keywords);
        if (is_array($result_searchvegetablename) || is_object($result_searchvegetablename)) {
            $output_vegetablelist .=   '<table class="table table-hover table-bordered" style="text-align: center">
                                            <thead>
                                                <tr class="table-active">
                                                    <th>Vegetable ID</th>
                                                    <th>Vegetable Name</th>
                                                    <th>Category</th>
                                                    <th>Picture</th>
                                                    <th>Amount</th>
                                                    <th>Unit</th>
                                                    <th>Selling Price</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="vegetable_list_tbody">';
            foreach ($result_searchvegetablename as $Vegetable) {
                $output_vegetablelist .=    '<tr>
                                                    <td>'.$Vegetable['VegetableID'].'</td>
                                                    <td>'.$Vegetable['VegetableName'].'</td>
                                                    <td>'.$Vegetable['CategoryName'].'</td>
                                                    <td><img src="'.$server_root.'/'.$Vegetable['Image'] .'"alt = "" width ="150px" class="img-fluid"></td>
                                                    <td>'.$Vegetable['Amount'].'</td>
                                                    <td>'.$Vegetable['Unit'].'</td>
                                                    <td>'.number_format($Vegetable['Price']).' VND</td>
                                                    <td>'.$Vegetable['Status'].'</td>
                                                    <td>
                                                        <a href="" class="update_vegetable_a" id="'.$Vegetable['VegetableID'].'">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="" class="hidden_vegetable_a" id="'.$Vegetable['VegetableID'].'">';
                                                        if ($Vegetable['Hidden'] == "yes") {
                                                            $stt = "fas fa-eye-slash";
                                                        } else $stt ="fas fa-eye";
                $output_vegetablelist .=                   '<i class="'.$stt.'"></i>
                                                        </a>
                                                        <a href="" class="delete_vegetable_a" id="'.$Vegetable['VegetableID'].'">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>';            
            }
                $output_vegetablelist .=   '</tbody> 
                                        </table>';
        }   else $output_vegetablelist .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";           
        echo $output_vegetablelist;


    }
?>
