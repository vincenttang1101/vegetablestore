<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/customer.php');
    session_start();
    $classCustomer = new customer();
    $Avatar = 'avatar/'. basename($_FILES['image']['name']);
    $target_file = $_SERVER['DOCUMENT_ROOT']. '/vegetablestore/customer/user/'.$Avatar;

    if ($_POST['provinces'] == "Province" || $_POST['districts'] == "District" || $_POST['wards'] == "Ward") {
        $information = array($_POST['Fullname'],$_POST['Phone'],$_POST['Email'],$_SESSION['yourID']);
        if ($_POST['provinces'] != "Province" || $_POST['districts'] != "District" || $_POST['wards'] != "Ward") {
            $result_customer = false;
        } else {
            if (empty($_FILES['image']['name'])) {
                $result_customer = $classCustomer->execute("UPDATE `customer`
                                                            SET `FullName`  = '$information[0]',
                                                                `Phone`     = '$information[1]',
                                                                `Email`     = '$information[2]'
                                                            WHERE `CustomerID` = '$information[3]'");
            } else {
                $a = move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                $result_customer = $classCustomer->execute("UPDATE `customer`
                                                            SET `FullName`  = '$information[0]',
                                                                    `Phone`     = '$information[1]',
                                                                    `Email`     = '$information[2]',
                                                                    `Avatar`    = '$Avatar'
                                                            WHERE `CustomerID` = '$information[3]'");
            }
        }
           
    } else if ($_POST['provinces'] != "Province" && $_POST['districts'] != "District" && $_POST['wards'] != "Ward") {
        if ($_POST['street'] == "" || $_POST['apartment_number'] == "") {
            $result_customer = false;
        } else {
            $information = array($_POST['Fullname'],$_POST['Phone'],$_POST['Email'],$_POST['apartment_number'],$_POST['street'],$_POST['provinces'],$_POST['districts'],$_POST['wards'],$_SESSION['yourID'],'avatar/'. basename($_FILES['image']['name']));
            if (!empty($_FILES['image']['name'])) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                $result_customer = $classCustomer->execute("UPDATE `customer`
                                                            SET `FullName`  = '$information[0]',
                                                                        `Phone`     = '$information[1]',
                                                                        `Email`     = '$information[2]',
                                                                        `apartment_number` = '$information[3]',
                                                                        `street`           = '$information[4]',
                                                                        `provinces_id`     = '$information[5]',
                                                                        `districts_id`     = '$information[6]',
                                                                        `wards_id`         = '$information[7]',
                                                                        `Avatar`    = '$information[9]'
                                                            WHERE `CustomerID` = '$information[8]'");
            } else {
                $result_customer = $classCustomer->execute("UPDATE `customer`
                                                                SET `FullName`  = '$information[0]',
                                                                    `Phone`     = '$information[1]',
                                                                    `Email`     = '$information[2]',
                                                                    `apartment_number` = '$information[3]',
                                                                    `street`           = '$information[4]',
                                                                    `provinces_id`     = '$information[5]',
                                                                    `districts_id`     = '$information[6]',
                                                                    `wards_id`         = '$information[7]',
                                                                WHERE `CustomerID` = '$information[8]'");
            }
            
            
        }
    }
       
    
       
    
        if ($result_customer) {
            echo '<script>alert("Your profile has been updated successfully")
                          window.location.replace("../user/index.php")
                  </script>';
        } else {
            echo '<script>alert("Your profile has been updated unsuccessfully")
                            window.location.replace("../user/index.php")
                    </script>';

        }
    
?>
 