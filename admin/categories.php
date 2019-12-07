<?php
	require_once ($_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php');
	if(!is_logged_in()){
		login_error_redirect();
	}

	$sql = "SELECT * FROM categories WHERE parent = 0";
	$result = $db->query($sql);
	$errors = array();
	$category = '';
	$post_parent = '';

	//edit category
	if(isset($_GET['edit']) && !empty($_GET['edit'])){
		$edit_id = (int)$_GET['edit'];
		$edit_id = sanitize($edit_id);
		$esql = "SELECT * FROM categories WHERE id = '$edit_id'";
		$eres = mysqli_fetch_assoc($db->query($esql));
	}

	//delete category
	if(isset($_GET['delete']) && !empty($_GET['delete'])){
		$delete_id = (int)$_GET['delete'];
		$delete_id = sanitize($delete_id);
		$dsql = "SELECT * FROM categories WHERE id = '$delete_id'";
		$dres = mysqli_fetch_assoc($db->query($dsql));
		$dpar_id = (int)$dres['parent'];

		if ($dpar_id == 0){
			$dsql = "DELETE FROM categories WHERE parent = '$delete_id'";
			$db->query($dsql);
		}

		$dsql = "DELETE FROM categories WHERE id = '$delete_id'";
		$db->query($dsql);
		header('Location: categories.php');
	}

	//process add category form
	if ((isset($_POST)) && (!empty($_POST))){
		$post_parent = sanitize($_POST['parent']);
		$category = sanitize($_POST['category']);
		$sql_form = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent'";
		
		if(isset($_GET['edit'])){
			$id = $eres['id'];
			$sql_form = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent' AND id != '$id'";
		}

		$fresult = $db->query($sql_form);
		$count = mysqli_num_rows($fresult);
		//if category blank
		if ( $category == '' ){
			$errors[] .= "The category cannot be left blank.";
		}

		//if in db
		if ($count > 0){
			$errors[] .= $category." already exists. Please choose a new category";
		}

		//display errors or update db
		if (!empty($errors)){
			//display errors
			$display = display_errors($errors); ?>
			<script type="text/javascript">
				jQuery('document').ready(function(){
					jQuery('#errors').html('<?= $display; ?>');
				});
			</script>
		<?php
		}else{
			//update db
			$update_db_sql = "INSERT INTO categories (category, parent) VALUES ('$category','$post_parent')";
			if (isset($_GET['edit'])){
				$update_db_sql = "UPDATE categories SET category = '$category', parent = '$post_parent' WHERE id = '$edit_id'";
			}
			$db->query($update_db_sql);
			header("Location: categories.php");
		}
	}

	$category_value = '';
	$p_id = 0;
	if(isset($_GET['edit'])){
		$category_value = $eres['category'];
		$p_id = $eres['parent'];
	}else{
		if(isset($_POST)){
			$category_value = $category;
			$p_id = $post_parent;
		}
	}
	include('includes/head_gen.php');
	include('includes/navigation.php');
?>

<div class="container-fluid colulu">
	<h2 class="text-center">Categories</h2><hr>
	<div class="row">
		<!-- Category Form -->
		<div class="col-md-6">
			<form class="fomr" action="categories.php<?= ((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
				<div class="form-group">
					<legend class="text-left"><?= ((isset($_GET['edit']))?'Edit ':'Add a ') ;?>Category</legend><hr>
					<div id="errors"></div>
					<label for="parent" class="float-left"><b>Parent</b></label>
					<select class="form-control" name="parent" id="parent">
						<option value="0"<?=(($p_id == 0)?' selected="selected"':'');?>>Parent</option>
						<?php while($parent = mysqli_fetch_assoc($result)): ?>
							<option value="<?= $parent['id']; ?>"<?= (($p_id==$parent['id'])?' selected="selected"':'');?>><?= $parent['category']; ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="category" class="float-left"><b>Category</b></label>
					<input type="text" class="form-control" name="category" id="category" value="<?= $category_value; ?>">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success float-left" value="<?= ((isset($_GET['edit']))?'Edit ':'Add ');?>Category">
				</div>
			</form>
		</div>
		<!-- Category Table -->
		<div class="col-md-6">
			<table class="table table-bordered table-sm text-left">
				<thead>
					<th>Category</th><th>Parent</th><th></th>
				</thead>
				<tbody>
					<?php 
						$sql = "SELECT * FROM categories WHERE parent = 0";
						$result = $db->query($sql);
					while($parent = mysqli_fetch_assoc($result)): 
						$parent_id = (int)$parent['id'];
						$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
						$child_result = $db->query($sql2);
					?>
						<tr class="bg-info">
							<td><?= $parent['category']; ?></td>
							<td>Parent</td>
							<td width="15%" align="center">
								<a href="categories.php?edit=<?= $parent['id']; ?>" class="btn btn-sm btn-light"><i class="fas fa-pencil-alt"></i></a>
								<a href="categories.php?delete=<?= $parent['id']; ?>" class="btn btn-sm btn-light"><i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
						<?php while($child = mysqli_fetch_assoc($child_result)): ?>
							<tr class="bg-light">
								<td class="text-center"><?= $child['category']; ?></td>
								<td class="text-center"><?= $parent['category']; ?></td>
								<td width="15%" align="center">
									<a href="categories.php?edit=<?= $child['id']; ?>" class="btn btn-sm btn-light"><i class="fas fa-pencil-alt"></i></a>
									<a href="categories.php?delete=<?= $child['id']; ?>" class="btn btn-sm btn-light"><i class="fas fa-trash-alt"></i></a>
								</td>
							</tr>
						<?php endwhile; ?>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
	include('includes/footer.php');
?>