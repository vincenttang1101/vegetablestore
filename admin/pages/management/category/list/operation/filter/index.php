<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
    $classCategory = new category();
    if (isset($_POST['FilterCategoryStatus'])) {
        $output_filterStatus = '';
        $Status = $_POST['FilterCategoryStatus'];
        
        if (empty($Status)) {
            $output_filterStatus .= "<div class='alert alert-danger' id='alert-danger'>You haven't selected a status to filter</div>";
        } else if ($Status == "*") {
            $result_FilterStatus = $classCategory->getAll();
            if (is_array($result_FilterStatus) || is_object($result_FilterStatus)) {
                $output_filterStatus .= '<table class="table table-hover table-bordered" style="text-align: center">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th>Details</th>
                                                        <th>CategoryID</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="category_list_tbody">';
                foreach ($result_FilterStatus as $Category) {
                    $output_filterStatus .= '<tr>
                                                <td>
                                                    <a href="'.$server_root.'/admin/pages/management/category/list/operation/details/categoryDetails.php?id='.$Category['CategoryID'].'"> 
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </td>
                                                <td>'.$Category['CategoryID'].'</td>
                                                <td>'.$Category['CategoryName'].'</td>
                                                <td>'.$Category['Description'].'</td>
                                                <td>
                                                    <a href="" class="update_category_a" id="'.$Category['CategoryID'].'">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="" class="hidden_category_a" id="'.$Category['CategoryID'].'">';
                                                    if ($Category['Hidden'] == "yes") {
                                                        $stt = "fas fa-eye-slash";
                                                    } else $stt = "fas fa-eye";  
                    $output_filterStatus .=             '<i class="'.$stt.'" id ="status"></i>
                                                    </a>
                                                    <a href="" class="delete_category_a" id="'.$Category['CategoryID'].'">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>';             
                }
                $output_filterStatus .=      '</tbody>
                                    </table>';
            } else $output_filterStatus .=  "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
        } else {
            $result_FilterStatus = $classCategory->filterStatus($Status);
            if (is_array($result_FilterStatus) || is_object($result_FilterStatus)) {
                 $output_filterStatus .= '<table class="table table-hover table-bordered" style="text-align: center">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th>Details</th>
                                                        <th>CategoryID</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="category_list_tbody">';
                foreach ($result_FilterStatus as $Category) {
                    $output_filterStatus .= '<tr>
                                                <td>
                                                    <a href="'.$server_root.'/admin/pages/management/category/list/operation/details/categoryDetails.php?id='.$Category['CategoryID'].'"> 
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </td>
                                                <td>'.$Category['CategoryID'].'</td>
                                                <td>'.$Category['CategoryName'].'</td>
                                                <td>'.$Category['Description'].'</td>
                                                <td>
                                                    <a href="" class="update_category_a" id="'.$Category['CategoryID'].'">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="" class="hidden_category_a" id="'.$Category['CategoryID'].'">';
                                                    if ($Category['Hidden'] == "yes") {
                                                        $stt = "fas fa-eye-slash";
                                                    } else $stt = "fas fa-eye";  
                    $output_filterStatus .=             '<i class="'.$stt.'" id ="status"></i>
                                                    </a>
                                                    <a href="" class="delete_category_a" id="'.$Category['CategoryID'].'">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>';             
                }
            } else $output_filterStatus .=  "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
        }

        echo $output_filterStatus;
        
    }
?>