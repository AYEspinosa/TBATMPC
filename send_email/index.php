<?php
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->SMTPAuth = true;

// eto ung magsesesnd
$mail->Username = 'edanogenesis028@gmail.com'; eto ung magsesend
$mail->Password = '09952916440watergreen';


//eto ung sesendan
$mail->setFrom('edanogenesis028@gmail.com', 'Genesis Edano');
$mail->addAddress('kabayotilapia@gmail.com');


$mail->Subject = 'nakakasend nako ng email';
$mail->Body = 'hi guys famous na ko!!!!!!';

if ($mail->send())
    echo "Mail sent";
?>