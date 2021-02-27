<?php
require('plugins/phpmailer/class.phpmailer.php');
$mail = new PHPMailer();

$mail->CharSet 		= "utf-8";
$mail->IsSMTP();
$mail->SMTPDebug 	= 0;
$mail->SMTPAuth 	= true;
$mail->Host 		= "mail.subsiri.com"; // SMTP server
$mail->Port 		= 25; // พอร์ท
$mail->Username 	= "subsiric@subsiri.com"; // account SMTP
$mail->Password 	= "]ECh;ek3Z5M1h8"; // รหัสผ่าน SMTP

$mail->SetFrom("subsiric@subsiri.com", "Support");
$mail->Subject =  'ติดต่อจากทางเว็บไซต์' . ' ' . 'คุณ' . $_POST['name'];

$msg = 'ชื่อ : ' . $_POST['name'] . '<br />';
$msg .= 'เบอร์โทรศัพท์ : ' . $_POST['phone'] . '<br />';
$msg .= 'อีเมล์ : ' . $_POST['email'] . '<br />';
$msg .= '-----------------------------------------------------------------------------------------------------------------------' . '<br />';
$msg .= 'เรื่องติดต่อ : ' . $_POST['subject'] . '<br />';
$msg .= 'ข้อความ : ' . $_POST['message'];

$mail->MsgHTML($msg);
$mail->AddAddress("chananatsie@gmail.com");

if(!$mail->Send()) {
    $message = 'error';
} else {
    $message = 'send';
}
?>