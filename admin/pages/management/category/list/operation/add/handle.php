<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
    $classCategory = new category();
    if (!empty($_POST)) {
        $Name = $_POST['CategoryName'];
        $Description = $_POST['Description'];
        $DataCategory = array($Name, $Description);
        $output_AddCategory = '';
        $result_AddCategory  = $classCategory->addCategory($DataCategory);
        if ($result_AddCategory) {
            $message = "The Category has been successfully added";
            $output_AddCategory .= "<div class='alert alert-success' id='alert-success'>".$message."</div>";
            $output_AddCategory .= '<table class="table table-hover table-bordered" style="text-align: center">
                                        <thead>
                                            <tr class="table-active">
                                                <th>Detail</th>
                                                <th>CategoryID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="category_list_tbody">';
            $Category = $classCategory->getAll();
            if (is_array($Category) || is_object($Category)) {
                foreach ($Category as $Category) {
                    $output_AddCategory .=     '<tr>
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
                    $output_AddCategory .=                  '<i class="'.$stt.'" id ="status"></i>
                                                        </a>
                                                        <a href="" class="delete_category_a" id="'.$Category['CategoryID'].'"> 
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>';           
                }
            $output_AddCategory .=      '</tbody>
                                </table>';
            }  else $output_AddCategory .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
        } else {
            $output_AddCategory .= "<div class='alert alert-danger' id='alert-danger'>The Category has been unsuccessfully added</div>";
        }
        echo $output_AddCategory;
    }      
?>