<?php

//user_fetch.php

include('database_connection.php');

$query = '';

$output = array();

$query .= "SELECT * FROM package ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR description LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach($result as $row)
{
	$status = '';
	if($row["package_status"] == 'active')
	{
		$status = '<span class="label label-success">active</span>';
	}
	else
	{
		$status = '<span class="label label-danger">inactive</span>';
	}
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['name'];
	$sub_array[] = $row['description'];
	$sub_array[] = $status;
	$sub_array[] = '<button type="button" name="'.$row["id"].'" id="'.$row["id"].'" class="btn btn-warning btn-sm update">Edit</button>  '.' <button type="button" name="change" id="'.$row["id"].'" class="btn btn-info btn-sm change">Delete</button> '.' <button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-sm delete" data-status="'.$row["package_status"].'">Change Status</button>';

	$data[] = $sub_array;
}

$output = array(
	"data"    			=> 	$data
);
echo json_encode($output);



?>