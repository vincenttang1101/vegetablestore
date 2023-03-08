<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php'); 
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
    $classCate = new category();
    if (isset($_POST['CategoryID'])) {
        $id = $_POST['CategoryID'];
        $result = $classCate->getByID($id);
        foreach ($result as $category) {
            if ($category['Hidden'] == "no") {
                $result_hidden = $classCate->HiddenCategory($id,"yes");
            }
            else {
                $result_hidden = $classCate->HiddenCategory($id,"no");
            }
        }
        $result_Category = $classCate->getAll();
        $output_category = '';
        if ($result_hidden) {
            if (is_array($result_Category) || is_object($result_Category)) {
                $message = "The Category has been successfully updated hidden";
                $output_category .= "<div class='alert alert-success' id='alert-success'>".$message."</div>";
                $output_category .= '<table class="table table-hover table-bordered" style="text-align: center">
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
                foreach ($result_Category as $Category) {
                    $output_category.=              '<tr>
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
                    $output_category .=                         '<i class="'.$stt.'" id ="status"></i>
                                                            </a>
                                                            <a href="" class="delete_category_a" id="'.$Category['CategoryID'].'">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>';                           
                }
                $output_category .=      '</tbody>
                                        </table>';
            } else $output_category .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
        } else {
                $output_category .= "<div class='alert alert-danger' id='alert-danger'>The Category has been unsuccessfully hiddened</div>";
        }

        echo $output_category;
    }
?>