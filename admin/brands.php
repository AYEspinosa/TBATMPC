<?php
	require_once('../core/init.php');
	if(!is_logged_in()){
		login_error_redirect();
	}

	$results = $db->query("SELECT * FROM brand ORDER BY brand");

	$errors = array();

	//delete brand
	if ( (isset($_GET['delete'])) && (!empty($_GET['delete'])) ){
		$delete_id = (int)$_GET['delete'];
		$delete_id = sanitize($delete_id);
		$db->query("DELETE FROM brand WHERE id = '$delete_id'");
		header("Location: brands.php");
	}

	//edit brand
	if ( (isset($_GET['edit'])) && (!empty($_GET['edit'])) ){
		$edit_id = (int)$_GET['edit'];
		$edit_id = sanitize($edit_id);
		$edit_result = $db->query("SELECT * FROM brand WHERE id = '$edit_id'");
		$e_brand = mysqli_fetch_assoc($edit_result);
	}


	//Add From Submitted
	if(isset($_POST['add_submit'])){
		$brand = sanitize($_POST['brand']);
		//check brand if blank
		if (($_POST['brand']) == ''){
			$errors[] .= "You Must Enter a Brand!";
		}

		//check brand if exists
		$brand_result = $db->query("SELECT * FROM brand WHERE brand = '$brand'");
		if (isset($_GET['edit'])) {
			$brand_result = $db->query("SELECT * FROM brand WHERE brand = '$brand' AND id != '$edit_id'");
		}

		$count = mysqli_num_rows($brand_result);
		if ($count > 0){
			$errors[] .= $brand." brand name already exists! Choose another brand name.";
		}

		//display errors
		if (!empty($errors)){
			echo display_errors($errors);
		}else{
			//Add brand to db
			$sql = "INSERT INTO brand (brand) VALUES ('$brand')";
			if (isset($_GET['edit'])){
				$sql = "UPDATE brand SET brand = '$brand' WHERE id = '$edit_id'";
			}
			$db->query($sql);
			header("Location: brands.php");
		}
	}
	
	include('includes/head_gen.php');
	include('includes/navigation.php');
?>
<div class="container-fluid colulu">
	<h2 class="text-center">Brands</h2><hr>
	<!-- Brand Form -->
	<div class="text-center" style="padding-left: 34%">
		<form class="form-inline" action="brands.php<?= ((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="POST">
			<div class="form-group">
				<?php 
				$brand_value = '';
				if (isset($_GET['edit'])){
					$brand_value = $e_brand['brand'];
				}else{
					if (isset($_POST['brand'])){
						$brand_value = sanitize($_POST['brand']);
					}
				}
				?>
				<label for="brand"><b><?= ((isset($_GET['edit']))?'Edit':'Add a'); ?> Brand:</b> &nbsp;</label>
				<input type="text" name="brand" id="brand" class="form-control" value="<?= $brand_value; ?>">&nbsp;
				<?php if((isset($_GET['edit']))): ?>
					<a href="brands.php" class="btn btn-warning">Cancel</a>&nbsp;
				<?php endif; ?>
				<input type="submit" name="add_submit" value="<?= ((isset($_GET['edit']))?'Edit':'Add'); ?> Brand" class="btn btn-md btn-success">
			</div>
		</form>
	</div><hr>
	<!-- -->
	<table class="table table-bordered table-striped table_modify table-sm">
		<thead>
			<th></th><th>Brand</th><th></th>
		</thead>
		<tbody>
			<?php while($brand = mysqli_fetch_assoc($results)): ?>
				<tr>
					<td width="10%"><a href="brands.php?edit=<?= $brand['id']; ?>" class="btn btn-sm btn-light"><i class="fas fa-edit"></i></a></td>
					<td><?= $brand['brand']; ?></td>
					<td width="10%"><a href="brands.php?delete=<?= $brand['id']; ?>" class="btn btn-sm btn-light"><i class="fas fa-times"></i></a></td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<?php
	include('includes/footer.php')
?>