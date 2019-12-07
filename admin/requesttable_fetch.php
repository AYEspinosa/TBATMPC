<?php
include('database_connection.php');

$query = '';

$output = array();

$query .= "SELECT * FROM rentalrequest ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE email LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR firstname LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR request_status LIKE "%'.$_POST["search"]["value"].'%" ';
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
	if($row["request_status"] == 'Accepted')
	{
		$status = '<div class="bg-success"><span class="label text-white">Accepted</span></div>';
	}
	else if ($row["request_status"] == 'Pending')
	{
		$status = '<div class="bg-warning"><span class="label text-white">Pending</span></div>';
	}
	else
	{
		$status = '<div class="bg-danger"><span class="label text-white">Rejected</span></div>';
	}
	$sub_array = array();
	$sub_array[] = $row['firstname'].' '.$row['lastname'];
	$sub_array[] = $row['startdate'].' to '.$row['enddate'];
	$sub_array[] = $row['van'].'-'.$row['package'];
	$sub_array[] = $row['comment'];
	$sub_array[] = $status;
	$sub_array[] = '<button type="button" name="'.$row["id"].'" id="'.$row["id"].'" class="btn btn-success btn-sm accept" data-status="'.$row["request_status"].'">Accept</button> '.' <button type="button" name="reject" id="'.$row["id"].'" class="btn btn-danger btn-sm reject" data-status="'.$row["request_status"].'">Reject</button> '.' <button type="button" name="'.$row["id"].'" id="'.$row["id"].'" class="btn btn-primary btn-sm viewmodal" data-target="#viewmodal" data-toggle="modal">View</button>';
	
	$data[] = $sub_array;
}

$output = array(
	"data"    			=> 	$data
);
echo json_encode($output);


?>