<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';
$errors = array();
if (isset($_POST['code']) && !empty($_POST['code'])){
	$original_code = sanitize($_POST['code']);
	$user_code = sanitize($_POST['f_code']);

	if($user_code != $original_code){
		$errors[] = "Code does not match!";
	}

	if(!empty($errors)){
		echo display_errors($errors);
	}else{
		echo 1;
	}
}