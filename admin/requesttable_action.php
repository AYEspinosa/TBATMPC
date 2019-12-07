<?php
require '../send_email/phpmailer/PHPMailerAutoload.php';
require_once ($_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php');

$id = $_POST['id'];
$query = "SELECT * FROM rentalrequest WHERE id = '$id'";
$statement = $db->query($query);
$reqR = mysqli_fetch_assoc($statement);
$emailshit = '';
$default_color = "#008000";

$output = array(
			'id'			=> $reqR['id'],
			'firstname'		=> $reqR['firstname'],
			'lastname'		=> $reqR['lastname'],
			'email'			=> $reqR['email'],
			'address'		=> $reqR['address'],
			'contactnumber'	=> $reqR['contactnumber'],
			'comment'		=> $reqR['comment'],
			'van'			=> $reqR['van'],
			'package'		=> $reqR['package'],
			'startdate'		=> $reqR['startdate'],
			'enddate'		=> $reqR['enddate'],
			'noofdays'		=> $reqR['noofdays'],
			'request_status'=> $reqR['request_status'],
			'code'			=> $reqR['code'],
		);
$msg = '';
$emailshit .= $output['email'];
$out = $output['van'];
$unitQ = mysqli_fetch_assoc($db->query("SELECT * FROM van WHERE unit = '$out'"));
$unit_id = $unitQ['id'];

if(isset($_POST['btn_action']))
{

	if($_POST['btn_action'] == 'fetch_single')
	{
		echo json_encode($output);
	}


	if($_POST['btn_action'] == 'accept')
	{	
		$unit = $output['van'];
		$query = "SELECT * FROM van WHERE unit = '$unit'";
		$statement = $db->query($query);
		$result = mysqli_fetch_assoc($statement);
		$output2 = array(
			'costperday' => '',
			);
		$output2['costperday'] = $result['costperday'];
		

		$bill = $output2['costperday']*$output['noofdays'];	

		$status = 'Pending';

		if($_POST['request_status'] == 'Pending')
		{


			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPSecure = "ssl";
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = 'tbatmpc.baguio@gmail.com';
			$mail->Password = 'W1inter001';

			$mail->setFrom('tbatmpc.baguio@gmail.com', 'TBATMPC');
			$mail->addAddress($emailshit);
			$mail->Subject = 'TBATMPC - Trusted Blistt Alliance of Transport Multi-Purpose Cooperative';
			$mail->Body = "Hello ".$output['firstname']."!\r\n\tYour vehicle rental request with TBATMPC has been approved.\r\nFullname: ".$output['firstname']." ".$output['lastname']."\r\nVan: ".$output['van']."\r\nPackage: ".$output['package']."\r\nPickup Point: ".$output['address']."\r\nPickup Date: ".$output['startdate']."\r\nReturn Date: ".$output['enddate']."\r\nRent Cost:  ".$bill.' PHP'.'see you on '.$output['startdate']."!"."\r\nThank you for patronizing the TBATMPC. For more information, contact as at 090909090 or email as at tbatmpc.baguio@gmail.com";

			if ($mail->send()){
			    $msg .= "Mail sent, ";
			}

			$status = 'Accepted';
			$start = $output['startdate']; 
			$end = $output['enddate'];
			$package = $output['package'];
			$unit = $output['van'];

			$sql = "INSERT INTO events (`title`, `unit`, `package`, `color`, `start`, `end`) VALUES ('$unit', '$unit_id', '$package', '$default_color', '$start', '$end')";
			$query = $db->query($sql);
			$msg .= "Event has been added!";
		}
		else if($_POST['request_status'] == 'Accepted')
		{
			exit('This request is already accepted');
		}
		else if($_POST['request_status'] == 'Rejected')
		{
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPSecure = "ssl";
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = 'tbatmpc.baguio@gmail.com';
			$mail->Password = 'W1inter001';

			$mail->setFrom('tbatmpc.baguio@gmail.com', 'TBATMPC');
			$mail->addAddress($emailshit);
			$mail->Subject = 'TBATMPC - Trusted Bliss Alliance of Transport Multi-Purpose Cooperative';
			$mail->Body = "Hello ".$output['firstname']."!\r\nWe are happy to say that due to some unexpected event, your request for a vehicle rent with the following info:\r\n"."Fullname: ".$output['firstname']." ".$output['lastname']."\r\nVan: ".$output['van']."\r\nPackage: ".$output['package']."\r\nPickup Point: ".$output['address']."\r\nPickup Date: ".$output['startdate']."\r\nReturn Date: ".$output['enddate']."\r\nhas been reconsidered. Our staff will call you in regards of this matter"."\r\nThank you for patronizing the TBATMPC. For more information, contact as at 090909090 or email as at tbatmpc.baguio@gmail.com";

			if ($mail->send()){
			    $msg .= "Mail sent, ";
			}
			$status = 'Accepted';
			$sql = "DELETE FROM events WHERE id = '$id'";
			$query = $db->query($sql);
			$msg .= "Event has been removed!";

		}
		
		$query = "UPDATE rentalrequest SET request_status = '$status' WHERE id = '$id'";
		$statement = $db->query($query);

		if(isset($statement))
		{
			$msg .= 'Request Status change to ' . $status.'.';
		}
		echo $msg;
		$msg = '';
	
	}
	
	if($_POST['btn_action'] == 'reject')
	{
		$status = 'Pending';
		if($_POST['request_status'] == 'Pending')
		{
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPSecure = "ssl";
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = 'tbatmpc.baguio@gmail.com';
			$mail->Password = 'W1inter001';

			$mail->setFrom('tbatmpc.baguio@gmail.com', 'TBATMPC');
			$mail->addAddress($emailshit);
			$mail->Subject = 'TBATMPC - Trusted Bliss Alliance of Transport Multi-Purpose Cooperative';
			$mail->Body = "Hello ".$output['firstname']."!\r\nYour vehicle rental request with TBATMPC has been rejected due to some unexpected reasons. You may try to send another rent request"."\r\nFullname: ".$output['firstname']." ".$output['lastname']."\r\nVan: ".$output['van']."\r\nPackage: ".$output['package']."\r\nPickup Point: ".$output['address']."\r\nPickup Date: ".$output['startdate']."\r\nReturn Date: ".$output['enddate']."\r\nThank you for patronizing the TBATMPC. For more information, contact as at 090909090 or email as at tbatmpc.baguio@gmail.com";

			if ($mail->send()){
			    $msg .= "Mail sent, ";

			}
			$status = 'Rejected';
		}
		else if($_POST['request_status'] == 'Accepted')
		{
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPSecure = "ssl";
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = 'tbatmpc.baguio@gmail.com';
			$mail->Password = 'W1inter001';

			$mail->setFrom('tbatmpc.baguio@gmail.com', 'TBATMPC');
			$mail->addAddress($emailshit);
			$mail->Subject = 'TBATMPC - Trusted Bliss Alliance of Transport Multi-Purpose Cooperative';
			$mail->Body = "Hello ".$output['firstname']."!\r\nWe are sorry to say that due to some unexpected event, your request for a vehicle rent with the following info:\r\n"."Fullname: ".$output['firstname']." ".$output['lastname']."\r\nVan: ".$output['van']."\r\nPackage: ".$output['package']."\r\nPickup Point: ".$output['address']."\r\nPickup Date: ".$output['startdate']."\r\nReturn Date: ".$output['enddate']."\r\nhas been cancelled. Our staff will call you in regards of this matter"."\r\nThank you for patronizing the TBATMPC. For more information, contact as at 090909090 or email as at tbatmpc.baguio@gmail.com";

			if ($mail->send()){
			    $msg .= "Mail sent, ";

			}
			$status = 'Rejected';
		}
		else if($_POST['request_status'] == 'Rejected')
		{
			exit('This request is already rejected');
		}
		$query = "UPDATE rentalrequest SET request_status = '$status' WHERE id = '$id'";
		$statement = $db->query($query);
		if(isset($statement))
		{
			$msg .= 'Request Status change to ' . $status;
		}

		echo $msg;
		$msg = '';
	}
}

?>