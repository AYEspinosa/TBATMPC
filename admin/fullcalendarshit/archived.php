<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';
if(!is_logged_in()){
		login_error_redirect();
}
include ('includes/head.php');
include ('includes/navigation.php');

$archresults = $db->query("SELECT * FROM products WHERE deleted = 1");
if (isset($_GET['restore'])){
	$restore_id = sanitize($_GET['restore']);
	$db->query("UPDATE products SET deleted = 0 WHERE id = '$restore_id'");
	header("Location: archived.php");
}

?>

<div class="container-fluid colulu">
	<h2 class="text-center">Archived Products</h2>
	<hr>
	<table class="table table-bordered table-condensed table-striped text-left">
		<thead>
			<th></th><th>Product</th><th>Price</th><th>Category</th><th>Sold</th>
		</thead>
		<tbody>
			<?php while ($archived = mysqli_fetch_assoc($archresults)): 
				$childID = $archived['categories'];
				$catSql = "SELECT * FROM categories WHERE id = '$childID'";
				$result = $db->query($catSql);
				$child = mysqli_fetch_assoc($result);
				$parentID = $child['parent'];
				$parSql = "SELECT * FROM categories WHERE id = '$parentID'";
				$pres = $db->query($parSql);
				$parent = mysqli_fetch_assoc($pres);
				$category = $parent['category'].' - '.$child['category'];
			?>
				<tr>
					<td width="8%" align="center">
						<a href="archived.php?restore=<?= $archived['id'];?>" class="btn btn-sm btn-light"><i class="fas fa-undo"></i></a>
					</td>
					<td> <?=$archived['title'];?> </td>
					<td> <?=money($archived['price']);?></td>
					<td> <?= $category; ?></td>
					<td>0</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>


<?php
include 'includes/footer.php';
?>