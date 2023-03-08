<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/staff.php');
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
    $classStaff = new staff();
    if (!empty($_POST)) {
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];
        $StaffName = $_POST['StaffName'];
        $Email = $_POST['Email'];  
        $Phone = $_POST['Phone'];
        $Address = $_POST['Address'];
        $Role = $_POST['Role'];
        $output_stafflist = '';
        $DataStaff = array ($Username, $Password, $StaffName, $Email, $Phone, $Address, $Role);
        $result_addstaff = $classStaff->addStaff($DataStaff);
        if ($result_addstaff) {
            $message = "The Staff has been successfully added";
            $output_stafflist .= "<div class='alert alert-success' id='alert-success'>".$message."</div>";
            $output_stafflist .= '<table class="table table-hover table-bordered" style="text-align:center">
                                    <thead>
                                        <tr class="table-active">
                                            <th style="width: 7%">Staff ID</th>
                                            <th>Username</th>
                                            <th style="width: 8%">Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th style="width: 5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="staff_list_tbody">';
            $result_staff = $classStaff->getAll();  
            if (is_array($result_staff) || is_object($result_staff)) {
                foreach ($result_staff as $Staff) {
                $output_stafflist .=    '<tr>
                                            <td>'.$Staff['StaffID'].'</td>
                                            <td>'.$Staff['Username'].'</td>
                                            <td>'.$Staff['StaffName'].'</td>
                                            <td>'.$Staff['Email'].'</td>
                                            <td>'.$Staff['Phone'].'</td>
                                            <td>'.$Staff['Address'].'</td>
                                            <td>'.$Staff['Role'].'</td>
                                            <td>
                                                <a href="" class="check_status_staff" id="'.$Staff['StaffID'].'">';
                                                if ($Staff['Role'] != "Admin") {    
                                                    if ($Staff['Status'] == "Active") {
                                                        $stt = "fas fa-toggle-on";
                                                    } else $stt = "fas fa-toggle-off";
                $output_stafflist .=                '<i style="font-size: 25px; color: #0040ff;" class="'.$stt.'"></i>  
                                                </a>';
                                                }
                $output_stafflist .=       '</td>
                                            <td>';
                                            if ($Staff['Role'] != "Admin") {
                $output_stafflist .=         '<a href="" class="update_staff_a" id="'.$Staff['StaffID'].'">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="" class="delete_staff_a" id="'.$Staff['StaffID'].'">
                                                    <i class="fas fa-trash"></i>
                                                </a>';
                                            }
                $output_stafflist .=       '</td>
                                        </tr>';
                }
            $output_stafflist .= '</tbody>
                                </table>';
            }  else $output_stafflist .= "<div class='alert alert-danger' id='alert-danger'>No result found</div>";
        } else {
            $output_stafflist .= "<div class='alert alert-danger' id='alert-danger'>The Staff has been unsuccessfully added</div>";
        } 
        echo $output_stafflist;                                    
    
    }
