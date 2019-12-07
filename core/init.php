<?php
$db = mysqli_connect('127.0.0.1', 'root', '', 'tbatmpc');

if(mysqli_connect_errno()){
	echo "<h1 align='center' style='color: red;'>Database connection failed with following errors: <br>". mysqli_connect_error()."</h1></div>";
	die();
}
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/TBATMPC/config.php');
require_once(BASEURL.'helpers/helpers.php');

$cart_id = '';
if(isset($_COOKIE[CART_COOKIE])){
	$cart_id = sanitize($_COOKIE[CART_COOKIE]);
}

if(isset($_SESSION['TBATUser'])){
	$user_id = $_SESSION['TBATUser'];
	$query = $db->query("SELECT * FROM users WHERE id = '$user_id'");
	$user_data = mysqli_fetch_assoc($query);
	$fn = explode(' ', $user_data['full_name']);
	$user_data['first'] = $fn[0];
	$user_data['last'] = $fn[1];
}

if(isset($_SESSION['success_flash'])){
	echo "<div class='bg-success text-center text-white'>".$_SESSION['success_flash']."<br></div>";
	unset($_SESSION['success_flash']);
}

if(isset($_SESSION['error_flash'])){
	echo "<div class='bg-danger text-center text-white'><br>".$_SESSION['error_flash']."<br><br></div>";
	unset($_SESSION['error_flash']);
}
?>