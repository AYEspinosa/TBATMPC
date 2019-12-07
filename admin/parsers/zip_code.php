<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';

$brgyOpts = "";
$city = sanitize($_POST['city_id']);
$selected = sanitize($_POST['selected']);
$cityQuery = mysqli_fetch_assoc($db->query("SELECT * FROM cities WHERE city = '$city'"));
$city_id = $cityQuery['id'];
$brgyQuery = $db->query("SELECT * FROM barangays WHERE city_id = '$city_id'");

ob_start();
?>
	<option value=""></option>
	<?php while($brgy = mysqli_fetch_assoc($brgyQuery)): ?>
		<option value="<?= $brgy['brgy']; ?>"<?=(($selected == $brgy['brgy'])?' selected':'');?>><?= $brgy['brgy'];?></option>;
	<?php endwhile; ?>
<?php
	echo ob_get_clean();
?>