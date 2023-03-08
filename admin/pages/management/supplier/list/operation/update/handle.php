<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/supplier.php');
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
    $classSupplier = new supplier();
    if (isset($_POST['SupplierID'])) {
        $SupplierID   = $_POST['SupplierID'];
        $SupplierName = $_POST['SupplierName'];
        $Email        = $_POST['Email'];
        $Phone        = $_POST['Phone'];
        $Address      = $_POST['Address'];
        $DataSupplier = array($SupplierID, $SupplierName, $Phone, $Email, $Address);
        $output_supplierlist = '';
        $result_updatesupplier = $classSupplier->updateSupplier($DataSupplier);
        if ($result_updatesupplier) {
            $message = "The Supplier has been successfully updated";
            $output_supplierlist .= "<div class='alert alert-success' id='alert-success'>".$message."</div>";
            $output_supplierlist .= '<table class="table table-hover table-bordered" style="text-align: center">
                                        <thead>
                                            <tr class="table-active">
                                                <th>Supplier ID</th>
                                                <th>Supplier Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="supplier_list_tbody">';
                                         $result_supplier = $classSupplier->getAll();
            if (is_array($result_supplier) || is_object($result_supplier)) {
                    foreach ($result_supplier as $Supplier) {
                    $output_supplierlist .= '<tr>
                                                <td>'.$Supplier['SupplierID'].'</td>
                                                <td>'.$Supplier['SupplierName'].'</td>
                                                <td>'.$Supplier['Phone'].'</td>
                                                <td>'.$Supplier['Email'].'</td>
                                                <td>'.$Supplier['Address'].'</td>
                                                <td>
                                                    <a href="" class="update_supplier_a" id="'.$Supplier['SupplierID'].'">
                                                        <i class="fas fa-edit"></i>
                                                    </a>';
                                                  
                
                    $output_supplierlist .=         '<a href="" clas="delete_supplier_a" id="'.$Supplier['SupplierID'].'">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>';
                    }
                $output_supplierlist .= '</tbody>
                                    </table>';
            }  else $output_supplierlist .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
        } else {
            $output_supplierlist .= "<div class='alert alert-danger' id='alert-danger'>The Supplier has been unsuccessfully updated</div>";
        }
        echo $output_supplierlist;
    }
    

?>