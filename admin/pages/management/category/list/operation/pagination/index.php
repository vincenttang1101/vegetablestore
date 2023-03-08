<?php  
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';

    $connect = mysqli_connect("localhost", "root", "", "vegetablestore");  
    $record_per_page = 5;  
    $page = '';  
    $output = ''; 
    if(isset($_POST["page"]))  {  
      $page = $_POST["page"];  
    }  else {
        $page = 1;
    }
    $start_from = ($page - 1)*$record_per_page;  
    $query = "SELECT * FROM `category` ORDER BY `CategoryID` DESC LIMIT $start_from, $record_per_page";  
    $result = mysqli_query($connect, $query);  
    $output .= '<table class="table table-hover table-bordered" style="text-align: center">
                                    <thead>
                                        <tr class="table-active">
                                            <th>Detail</th>
                                            <th>CategoryID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>';
    while($Category = mysqli_fetch_array($result)) {
            $output              .=     '<tr>
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
            $output .=                  '<i class="'.$stt.'" id ="status"></i>
                                                </a>
                                                <a href="" class="delete_category_a" id="'.$Category['CategoryID'].'"> 
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                             </td>
                                        </tr>';        
    }
    $output .=  '</tbody>
                            </table>';
    $page_query = "SELECT * FROM `category` ORDER BY `CategoryID` DESC";    
    $page_result = mysqli_query($connect, $page_query); 
    $total_records = mysqli_num_rows($page_result);  
    $total_pages = ceil($total_records/$record_per_page);  
    for($i=1; $i<=$total_pages; $i++)  
    {  
            $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
    }  
    $output .= '</div><br /><br />';  
    echo $output;  
                
?>