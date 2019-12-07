<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';

$city = sanitize($_POST['city']);
$cityQuery = mysqli_fetch_assoc($db->query("SELECT * FROM cities WHERE city = '$city'"));
$city_id = $cityQuery['id'];

$zipQuery = mysqli_fetch_assoc($db->query("SELECT * FROM zipc WHERE city_id = '$city_id'"));
$zip_code = $zipQuery['zip_code'];

echo $zip_code;

?>