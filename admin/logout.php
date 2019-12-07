<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';
unset($_SESSION['TBATUser']);
header("Location: login.php");
?>