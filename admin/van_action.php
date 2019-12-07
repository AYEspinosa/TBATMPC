<?php

//user_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO van (unit, costperday, description, Chassis, Plate, Motor) 
		VALUES (:unit, :rentrate, :description, :Chassis, :Plate, :Motor)
		";	
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':unit'		=>	$_POST["unit"],
				':rentrate'		=>	$_POST["rentrate"],
				':description'		=>	$_POST["description"],
				':Chassis'		=>	$_POST["Chassis"],
				':Plate'		=>	$_POST["Plate"],
				':Motor'		=>	$_POST["Motor"],
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'New unit Added';
		}
	}

	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "
		SELECT * FROM van WHERE id = :id
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
			$output['unit'] = $row['unit'];
			$output['rentrate'] = $row['costperday'];
			$output['description'] = $row['description'];
			$output['Chassis'] = $row['Chassis'];
			$output['Plate'] = $row['Plate'];
			$output['Motor'] = $row['Motor'];
		}
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'Edit')
	{
			
		
			$query = "
			UPDATE van SET 
				unit = '".$_POST["unit"]."', 
				description = '".$_POST["description"]."',
				costperday = '".$_POST["rentrate"]."',
				Chassis = '".$_POST["Chassis"]."',
				Plate = '".$_POST["Plate"]."',
				Motor = '".$_POST["Motor"]."'
				WHERE id = '".$_POST["id"]."'
			";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Car Details Edited';
		}
	}

	if($_POST['btn_action'] == 'delete')
	{
		$status = 'active';
		if($_POST['van_status'] == 'active')
		{
			$status = 'inactive';
		}
		$query = "
		UPDATE van 
		SET van_status = :van_status 
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':van_status'	=>	$status,
				':id'		=>	$_POST["id"]
			)
		);	
		$result = $statement->fetchAll();	
		if(isset($result))
		{
			echo 'Car Status change to ' . $status;
		}
	}

	if($_POST['btn_action'] == 'change')
	{
		$query = "
		DELETE FROM van WHERE id = :id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'		=>	$_POST["id"]
			)
		);	
		$result = $statement->fetchAll();	
		if(isset($result))
		{
			echo ' Deleted ';
		}
	}
}

?>