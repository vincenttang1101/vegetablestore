<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/customer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/mail/src/PHPMailer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/mail/src/Exception.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/mail/src/OAuth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/mail/src/POP3.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/mail/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$classCus = new customer();
if (isset($_POST['Email'])) {
    $email = $_POST['Email'];
    $result_email = $classCus->executeResult("SELECT * FROM `customer` WHERE `Email` = '$email'");
    foreach ($result_email as $getE) {}

$nFrom = "VegetableStore";    //mail duoc gui tu dau, thuong de ten cong ty ban
$mFrom = 'tangtrinhquang@gmail.com';  //dia chi email cua ban 
$mPass = 'Quangid1234';       //mat khau email cua ban
$nTo = 'tangtrinhquang'; //Ten nguoi nhan
$mTo = 'truonghongphatg@gmail.com';   //dia chi nhan mail
$mail             = new PHPMailer();
$body             = $getE['Password'];   // Noi dung email
$title = 'Get Passsword';   //Tieu de gui mail
$mail->IsSMTP();             
$mail->CharSet  = "utf-8";
$mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;    // enable SMTP authentication
$mail->SMTPSecure = "tls";   // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";    // sever gui mail.
$mail->Port       = 587;         // cong gui mail de nguyen
// xong phan cau hinh bat dau phan gui mail
$mail->Username   = $mFrom;  // khai bao dia chi email
$mail->Password   = $mPass;              // khai bao mat khau
$mail->SetFrom($mFrom, $nFrom);
$mail->AddReplyTo('tangtrinhquasng@gmai.com', 'vegetablestore.net'); //khi nguoi dung phan hoi se duoc gui den email nay
$mail->Subject    = $title;// tieu de email 
$mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
$mail->AddAddress($mTo, $nTo);
var_dump($mail->AddAddress($mTo, $nTo));
// thuc thi lenh gui mail 
if(!$mail->Send()) {
    echo 'Error';
     
} else {
     
    echo 'mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả. ';
}
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="" method="post">
  <label>Email:</label><br>
  <input type="text"  name="Email"><br><br>
  <input type="submit" value="Submit">
</form> 

</body>
</html>

