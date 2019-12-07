<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}

$hashed = $user_data['password'];
$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password = trim($old_password);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm = trim($confirm);
$new_hashed = password_hash($password, PASSWORD_DEFAULT);
$user_id = $user_data['id'];
$errors = array();
include ('includes/head.php');
?>
<style>
    #login-form{
	width:40%;
	height:60%;
	border:2px solid #000;
	border-radius:15px;
	box-shadow: 7px 7px 15px rgba (0,0,0,0,6);
	margin: 4% auto;
	padding: 15px;
	background-color: #fff;
}


</style>

<div id="login-form" >
	<div>
		<?php
			if($_POST){
				if(empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])){
					$errors[] = "Fill out all the fields!";
				}

				if(strlen($password) < 6){
					$errors[] = "Password must be at least 6 characters.";
				}

				if($password != $confirm){
					$errors[] = "The new password does not match with confirm password.";
				}

				if(!password_verify($old_password, $hashed)){
					$errors[] = "Your old password does not match with our records.";
				}


				if (!empty($errors)){
					echo display_errors($errors);
				}else{
					$db->query("UPDATE users SET password = '$new_hashed' WHERE id = '$user_id'");
					$_SESSION['success_flash'] = "Your password has been updated!";
					header("Location: index.php");
				}
			}

		?>
	</div>
	<h2 class="text-center"> Change Password </h2> <hr>
	<form action="change_password.php" method="post">
		<div class="form-group" align="left">
			<label for="old_password">Old Password:</label>
			<input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
		</div>
		<div class="form-group" align="left">
			<label for="password">New Password</label>
			<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
		</div>
		<div class="form-group" align="left">
			<label for="confirm">Confirm New Password</label>
			<input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
		</div>
		<div class="form-group" align="left">
			<a href="index.php" class="btn btn-warning">Cancel</a>
			<input type="submit" value="Change Password" class="btn btn-primary">
		</div>
	</form>
	<p class="text-right"> <a href="/TBATMPC/index.php" alt="home"> Visit Site </a> </p>
</div>

<?php
include ('includes/footer.php');
?>