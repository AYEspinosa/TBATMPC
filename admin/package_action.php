<?php

//user_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO package (name, description) 
		VALUES (:name, :description)
		";	
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':name'		=>	$_POST["package"],
				':description'		=>	$_POST["description"],
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'New Package Added';
		}
	}

	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "
		SELECT * FROM package WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'	=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['name'] = $row['name'];
			$output['description'] = $row['description'];
		}
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'Edit')
	{
			
		
			$query = "
			UPDATE package SET 
				name = '".$_POST["package"]."', 
				description = '".$_POST["description"]."'
				WHERE id = '".$_POST["id"]."'
			";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'package Details Edited';
		}
	}

	if($_POST['btn_action'] == 'delete')
	{
		$status = 'active';
		if($_POST['package_status'] == 'active')
		{
			$status = 'inactive';
		}
		$query = "
		UPDATE package 
		SET package_status = :package_status 
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':package_status'	=>	$status,
				':id'		=>	$_POST["id"]
			)
		);	
		$result = $statement->fetchAll();	
		if(isset($result))
		{
			echo 'Package Status change to ' . $status;
		}
	}

	if($_POST['btn_action'] == 'change')
	{
		$query = "
		DELETE FROM package WHERE id = :id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'		=>	$_POST["id"]
			)
		);	
		$result = $statement->fetchAll();	
		if(isset($result))
		{
			echo 'Deleted ';
		}
	}
}

?>