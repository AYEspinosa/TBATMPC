<?php
	require_once('../core/init.php');
	if(!is_logged_in()){
		login_error_redirect();
	}
	if(!has_permission('admin')){
		permission_error_redirect('index.php');
	}

	if(isset($_GET['delete'])){
		$delete_id = sanitize($_GET['delete']);
		$perms = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE id = '{$delete_id}'"));
		$mga_permiso = explode(",", $perms['permissions']);
		if(!in_array("superadmin", $mga_permiso)){
			$db->query("DELETE FROM users WHERE id = '$delete_id'");
			$_SESSION['success_flash'] = "User has been deleted.";
			header("Location: users.php");
		}else{
			$_SESSION['error_flash'] = "Super User cannot be deleted!";
			header("Location: users.php");
		}
	}
	if (isset($_GET['add'])) {
		$name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
		$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
		$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
		$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
		$permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
		$errors = array();

		if($_POST){
			$emailQuery = $db->query("SELECT * FROM users WHERE email = '$email'");
			$emailCount = mysqli_num_rows($emailQuery);

			if ($emailCount != 0) {
				$errors[] = "That email already exists in our database.";
			}
			$required = array('name', 'email', 'password', 'confirm', 'permissions');
			foreach($required as $field){
				if (empty($_POST[$field])) {
					$errors[] = "You must fill out all fields.";
					break;
				}
			}
			if(strlen($password) < 6){
				$errors[] = "Password is too short, must be atleast 6 characters.";
			}
			if($password != $confirm){
				$errors[] = "Your passwords do not match.";
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[] = "You must enter a valid email.";
			}

			if (!empty($errors)){
				echo display_errors($errors);
			}else{
				$hashed = password_hash($password, PASSWORD_DEFAULT);
				$db->query("INSERT INTO users (`full_name`, `email`, `password`, `permissions`) VALUES ('$name', '$email' ,'$hashed' ,'$permissions')");
				$_SESSION['success_flash'] = "User has been added!";
				header("Location: users.php");
			}
		}
	include('includes/head_gen.php');
	include('includes/navigation.php');
?>
			<div class="container-fluid colulu">
				<h2 class="text-center">Add a New User</h2>
				<hr>
				<form action="users.php?add=1" method="post">
					<div class="form-group col-md-6" style="display: inline-block; margin-left: -4px;">
						<label for="name">Full Name:</label>
						<input type="text" name="name" id="name" class="form-control" value="<?= $name;?>">
					</div>
					<div class="form-group col-md-6" style="display: inline-block; margin-left: -4px;">
						<label for="email">Email:</label>
						<input type="email" name="email" id="email" class="form-control" value="<?= $email;?>">
					</div>
					<div class="form-group col-md-6" style="display: inline-block; margin-left: -4px;">
						<label for="password">Password:</label>
						<input type="password" name="password" id="password" class="form-control" value="<?= $password;?>">
					</div>
					<div class="form-group col-md-6" style="display: inline-block; margin-left: -4px;">
						<label for="confirm">Confirm Password:</label>
						<input type="password" name="confirm" id="confirm" class="form-control" value="<?= $confirm;?>">
					</div>
					<div class="form-group col-md-6" style="display: inline-block; margin-left: -4px;">
						<label for="permissions">Permissions:</label>
						<select class="form-control" name="permissions">
							<option value="" <?= (($permissions == '')?' selected':''); ?>></option>
							<option value="editor" <?= (($permissions == 'editor')?' selected':''); ?>>Editor</option>
							<option value="admin,editor" <?= (($permissions == 'admin,editor')?' selected':''); ?>>Admin</option>
						</select>
					</div>
					<div class="form-group col-md-6 text-right" style="display: inline-block; margin-left: -4px;">
						<a href="users.php" class="btn btn-warning">Cancel</a>
						<input type="submit" value="Add User" class="btn btn-success" name="">
					</div>
				</form>
			</div>

<?php
	}else{
	$userQuery = $db->query("SELECT * FROM users ORDER BY full_name");
	include('includes/head_gen.php');
	include('includes/navigation.php');
	$user_logged_in = sanitize($_SESSION['TBATUser']);
	$permiso = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE id = '{$user_logged_in}'"));
	$permisos = explode(",",$permiso['permissions']);
?>
<div class="container-fluid colulu">
	<h2 class="text-center">Users</h2>
	<a href="users.php?add=1" class="btn btn-success pull-right" id="add-product-btn" <?= ((!in_array("superadmin", $permisos))?' hidden':''); ?>>Add New User</a><div class="clearfix"></div>
	<hr>
	<table class="table table-bordered table-striped table-condensed">
		<thead>
			<th></th><th>Name</th><th>Email</th><th>Join Date</th><th>Last Login</th><th>Permissions</th>
		</thead>
		<tbody>
			<?php while($user = mysqli_fetch_assoc($userQuery)): ?>
				<tr>
					<td> 
						<?php if($user['id'] != $user_data['id']): ?>
							<a href="users.php?delete=<?= $user['id'];?>" class="btn btn-light btn-sm"><i class="fas fa-times"></i> </a>
						<?php endif; ?>
					</td>
					<td><?= $user['full_name']; ?></td>
					<td><?= $user['email']; ?></td>
					<td><?= pretty_date($user['join_date']); ?></td>
					<td><?= (($user['last_login'] == '0000-00-00 00:00:00')?'Never':pretty_date($user['last_login'])); ?></td>
					<td><?= $user['permissions']; ?></td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>



<?php
	}
	include('includes/footer.php');
?>