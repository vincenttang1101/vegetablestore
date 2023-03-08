<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
    if (isset($_POST['CategoryID'])) {
        $CategoryID = $_POST['CategoryID'];   
        $classCategory = new category();
        $DeleteCategory = $classCategory->deleteByID($CategoryID);
        $output_CategoryList = '';
        if ($DeleteCategory) {
            $message = "The Category has been successfully deleted";
            $result_CategoryList =$classCategory->getAll();
            if (is_array($result_CategoryList) || is_object($result_Category)) {
                $output_CategoryList .= "<div class='alert alert-success' id='alert-success'>".$message."</div>";
                $output_CategoryList .= '<table class="table table-hover table-bordered" style="text-align: center">
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
                foreach ($result_CategoryList as $Category) {
                    $output_CategoryList.=          '<tr>
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
                    $output_CategoryList .=                 '<i class="'.$stt.'" id ="status"></i>
                                                            </a>
                                                            <a href="" class="delete_category_a" id="'.$Category['CategoryID'].'">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                     </tr>';   
                } 
                $output_CategoryList .=         '</tbody>
                                         </table>';
            } else {
                    $output_CategoryList .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
            }
                echo $output_CategoryList;
            } else {
                $output_CategoryList .= "<div class='alert alert-danger' id='alert-danger'>The Category has been unsuccessfully deleted</div>";
                echo $output_CategoryList;
            }
        }
?>