<?php
require_once 'core/init.php';
require 'send_email/phpmailer/PHPMailerAutoload.php';

$order_no = '';
$grand_amount = sanitize($_POST['total']);
$grand_amount = str_replace(",", "", $grand_amount);
$grand_amount = number_format($grand_amount, 2, '.', '');
$full_name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$contact = sanitize($_POST['number']);
$street = sanitize($_POST['address']);
$street = rtrim($street, ',');
$address_array = explode(" ", $street);
$zip_code = array_values(array_slice($address_array, -1))[0];
$city = sanitize($_POST['city']);
$pay_meth = sanitize($_POST['pay_meth']);

$cityQ = $db->query("SELECT * FROM cities WHERE city = '$city'");
$cityRes = mysqli_fetch_assoc($cityQ);
$city_name = $cityRes['city'];

$domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);

for ($i=0; $i<4; $i++){
	$order_str = '';
	$letter = chr(rand(65,90));
	$number = mt_rand(0, 9);
	$number = (string)$number;
	$order_str = $letter.$number;
	$order_no .= $order_str;
}

// for decreasing the value of available
// array(1) { [0]=> array(3) { ["id"]=> string(1) "3" ["size"]=> string(6) "Medium" ["quantity"]=> string(1) "3" } }
// "Small:1,Medium:1,Large:2"
$cartQuery = $db->query("SELECT * FROM cart WHERE id = '$cart_id'");
$available_dec = mysqli_fetch_assoc($cartQuery);
$items = json_decode($available_dec['items'], true);
$updated_quantity = '';
foreach ($items as $item) {
	$updated_quantity = '';
	$product_id = $item['id'];
	$p_quantity = $item['quantity'];
	$p_size = $item['size'];

	$productQuery = $db->query("SELECT * FROM products WHERE id = '$product_id'");
	$product = mysqli_fetch_assoc($productQuery);
	$product_sizes = $product['sizes'];
	$sizes_arr = explode(',',$product_sizes);

	foreach ($sizes_arr as $size) {
		$sizeString = array();
		$sizeString = explode(':', $size);
		$sizeName = $sizeString[0];
		$available_stock = $sizeString[1];
		$threshold = $sizeString[2];
		if ($sizeName == $p_size){
			$available_stock = $available_stock - $p_quantity;
			$upload_size = $sizeName.':'.$available_stock.':'.$threshold.',';
			$updated_quantity .= $upload_size;
		}else{
			$updated_quantity .= $sizeName.':'.$available_stock.':'.$threshold.',';
		}
	}
	$updated_quantity = rtrim($updated_quantity,',');
	$updat_prod = $db->query("UPDATE products SET sizes = '$updated_quantity' WHERE id = '$product_id'");
}

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->SMTPAuth = true;
// eto ung magsesesnd
$mail->Username = 'tbatmpc.baguio@gmail.com';
$mail->Password = 'W1inter001';
//eto ung sesendan
$mail->setFrom('tbatmpc.baguio@gmail.com', 'TBATMPC-Alfonso Gabriel Tabeta');
$mail->addAddress($email);
$mail->Subject = 'CUSTOMER ORDER('.$order_no.') @ TBATMPC - Information';
$mail->Body = "Dear ".$full_name.", \r\n\r\nThanks for shopping with us! We are glad to inform you that your order ".$order_no." is being processed at the moment. After evaluation we will send you another email regarding with your order.\r\n\r\nName: ".$full_name.",\r\nAddress: ".$street.', '.$cityRes['city']."\r\nContact Number: 0".$contact.",\r\nPayment: ".ucfirst($pay_meth)."\r\nTotal Amount: ".money($grand_amount)."\r\nThank you for shopping with us!";

if ($mail->send()){
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPSecure = "ssl";
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	// eto ung magsesesnd
	$mail->Username = 'tbatmpc.baguio@gmail.com';
	$mail->Password = 'W1inter001';
	//eto ung sesendan
	$mail->setFrom('tbatmpc.baguio@gmail.com', 'TBATMPC-Alfonso Gabriel Tabeta');
	$mail->addAddress("tbatmpcbaguio.sales@gmail.com");
	$mail->Subject = 'CUSTOMER ORDER('.$order_no.') @ TBATMPC - Information';
	$mail->Body = "ORDER NO: ".$order_no."\r\n\tFull Name:".$full_name."\r\n\tAddress: ".$street.', '.$cityRes['city'].' '.$zip_code."\r\n\tContact Number: 0".$contact."\r\n\tPayment: ".ucfirst($pay_meth);
	$mail->send();
	$city_name = $cityRes['city'];
	$address = $street.', '.$city_name.' '.$zip_code;
	$db->query("UPDATE cart SET paid= 1 WHERE id='$cart_id'");
	$db->query("
		INSERT INTO `transactions`(`full_name`, `address`, `email`, `city`, `zip`, `pay_meth`, `cart_id`, `grand_amount`, `paid`)
		VALUES ('{$full_name}','{$address}','{$email}','{$city_name}','{$zip_code}','{$pay_meth}','{$cart_id}','{$grand_amount}',1)");
}
?>

<?php

	$db->query("UPDATE cart SET paid = 1 WHERE id = '$cart_id'");
	setcookie(CART_COOKIE,'',1,'/',$domain,false);

	include 'includes/head.php';
	include 'includes/navigation.php';
	include 'includes/headerpartial.php';
?>

<div align="center">
	<h2 class="text-center text-success">Thank you for shopping with us! We sent you an email regarding your shopping information!</h2><br>
	<a href="index.php" align="center">Back to Home</a>
</div>
<?php
include 'includes/footer.php'; ?>
