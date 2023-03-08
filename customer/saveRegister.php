<?php
require_once('../class/customer.php');

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (!empty([$_POST]) && isset($_POST['btn_register'])) {
  $s_fullname = test_input($_POST['fullname']);
  $s_email = test_input($_POST['email']);
  $s_username = test_input($_POST['username']);
  $s_pwd = test_input($_POST['password']);

  $s_phone = test_input($_POST['phone']);
  $s_apartment_number = test_input($_POST['apartment_number']);
  $s_street = test_input($_POST['street']);
  $s_provinces = test_input($_POST['provinces']);
  $s_districts = test_input($_POST['districts']);
  $s_wards = test_input($_POST['wards']);
  $cus = array($s_fullname, $s_email, $s_username, $s_pwd, $s_phone, $s_apartment_number, $s_street, $s_provinces, $s_districts, $s_wards);
  $customer = new customer();
  $result_cus = $customer->getAll();
  $c_temp = 0;
  foreach ($result_cus as $temp_cus) {
    if ($temp_cus['Email'] == $s_email || $temp_cus['Username'] == $s_username) {
      echo "<script>alert('Duplicate Username or Email !')</script>";
      $c_temp++;
    }
  }
  if ($c_temp == 0) {
    $result = $customer->add_cus($cus);
    if ($result == false) {
      echo "<script>alert('Invalid registration !')</script>";
    } else {
      echo "<script>alert('Sign Up Success !')
                  window.location ='login.php' </script>";
    }
  }
}
