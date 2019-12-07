<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';
require '../../send_email/phpmailer/PHPMailerAutoload.php';
$code = sanitize($_POST['code']);

$full_name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$number = sanitize($_POST['number']);
$street = sanitize($_POST['street']);
$city = sanitize($_POST['city']);
$zip_code = sanitize($_POST['zip_code']);
$errors = array();
$required = array(
	'full_name' => 'Full Name',
	'email' 	=> 'Email',
	'number'	=> 'Contact Number',
	'street'	=> 'Street Address',
	'city'		=> 'City'
);

foreach ($required as $field => $disp){
	if(empty($_POST[$field]) || $_POST[$field] == ''){
		$errors[] = $disp.' is required';
	}
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$errors[] = "Please enter a valid email.";
}
if ($number < 9000000000 || $number > 9999999999){
	$errors[] = "Please enter a valid number.";
}
if (!empty($errors)){
	echo display_errors($errors);
}else{
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPSecure = "ssl";
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	$mail->Username = 'tbatmpc.baguio@gmail.com';
	$mail->Password = 'W1inter001';

	$mail->setFrom('tbatmpc.baguio@gmail.com', 'TBATMPC');
	$mail->addAddress($email);
	$mail->Subject = 'Trusted Blistt Alliance of Transport Multi-Purpose Cooperative - Confirmation Code';
	$mail->Body = "Hello ".$full_name.",\r\n\tHere is your code: ".$code.", for the sole purpose of confirmation of your order. Thank you for patronizing TBATMPC!";
	$mail->send();
	echo 1;
}
?>