<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';
require 'send_email/phpmailer/PHPMailerAutoload.php';

$send = 0;
if(isset($_POST['key'])){

	if($_POST['key'] == 'codesubmit'){
		$errors = array();
		$firstname = sanitize($_POST['firstname']);
		$lastname = sanitize($_POST['lastname']);
		$email = sanitize($_POST['email']);
		$address = sanitize($_POST['address']);
		$contactnumber = sanitize($_POST['contactnumber']);
		$unit_id = sanitize($_POST['unit']);
		$package = sanitize($_POST['package']);
		$startdate = sanitize($_POST['startdate']);
		$enddate = sanitize($_POST['enddate']);
		$days = sanitize($_POST['days']);
		$comment = sanitize($_POST['comment']);
		$code = sanitize($_POST['code']);

		$unitQ = $db->query("SELECT * FROM van WHERE id = '$unit_id'");
		$unitR = mysqli_fetch_assoc($unitQ);
		$unit = $unitR['unit'];

		$errors = array();
		$required = array(
			'firstname' 		=> 'First Name',
			'lastname' 			=> 'Last Name',
			'email'				=> 'Email',
			'address'			=> 'Address',
			'contactnumber'		=> 'Contact Number',
			'unit'				=> 'Unit',
			'package'			=> 'Package',
			'startdate'			=> 'Pick-up Date',
			'enddate'			=> 'Return Date',
			'days'				=> 'Number of Days',
		);

		$sql = $db->query("SELECT id FROM rentalrequest WHERE firstname = '$firstname' AND lastname = '$lastname' AND email = '$email' AND van = '$unit' AND package = '$package' AND startdate = '$startdate' AND enddate = '$enddate'");

		if ($sql-> num_rows > 0) {
         	$errors[] = 'Already exists!';
        }

		foreach ($required as $field => $disp){
			if(empty($_POST[$field]) || $_POST[$field] == ''){
				$errors[] = $disp.' is required';
			}
		}

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Please enter a valid email.";
		}
		if ($contactnumber < 9000000000 || $contactnumber > 9999999999){
			$errors[] = "Please enter a valid number.";
		}
		
		if (!empty($errors)){
			echo display_errors($errors);
		}else{
			$sql = $db->query("SELECT start, end FROM events WHERE start = '$startdate' OR end = '$enddate'");
			if ($sql-> num_rows > 0){
	         	$errors[] = 'Conflict';
			}else{
				$subenddate_year = substr($enddate, 0, 4);
				$subenddate_month = substr($enddate, 5, 2);
				$subenddate_day = substr($enddate, 8, 2);
				$substartdate_year = substr($startdate, 0, 4);
				$substartdate_month = substr($startdate, 5, 2);
				$substartdate_day = substr($startdate, 8, 2);
				$intsubenddate_year = (int)$subenddate_year;
				$intsubenddate_month = (int)$subenddate_month;
				$intsubenddate_day = (int)$subenddate_day;
				$intsubstartdate_year = (int)$substartdate_year;
				$intsubstartdate_month = (int)$substartdate_month;
				$intsubstartdate_day = (int)$substartdate_day;

				if ($intsubenddate_year < $intsubstartdate_year){
		         	$errors[] = 'Year conflict';
				}elseif ($intsubenddate_month < $intsubstartdate_month && $intsubenddate_year <= $intsubstartdate_year){
			        $errors[] = 'Month conflict';
				}elseif ($intsubenddate_day < $intsubstartdate_day && $intsubenddate_month <= $intsubstartdate_month && $intsubenddate_year <= $intsubstartdate_year){
		         	$errors[] = 'Day conflict';
				}else{
					$reqQ = $db->query("SELECT * FROM van WHERE id = '$unit_id'");
					$reqR = mysqli_fetch_assoc($reqQ);
					$motor = $reqR['Motor'];
					$chassis = $reqR['Chassis'];
					$plate_no = $reqR['Plate'];
					$unit_color = $reqR['description'];
					$mail = new PHPMailer();
					$mail->isSMTP();
					$mail->Host = "smtp.gmail.com";
					$mail->SMTPSecure = "ssl";
					$mail->Port = 465;
					$mail->SMTPAuth = true;
					$mail->Username = 'tbatmpc.baguio@gmail.com';
					$mail->Password = 'W1inter001';

					$mail->setFrom('tbatmpc.baguio@gmail.com', 'TBATMPC');
					$mail->addAddress($email);
					$mail->Subject = 'TBATMPC - Trusted Blistt Alliance of Transport Multi-Purpose Cooperative';
					$mail->Body = "Hello ".$firstname.'!'."\r\nGood day. Here is your confirmation code: ".' '.' '.$code.", Kindly use this code to verify your request. Informations of your request as follows:"."\r\nFullname: ".$firstname.' '.$lastname."\r\nVan: ".$unit."\r\nPackage: ".$package."\r\nPickup Point: ".$address."\r\nPickup Date: ".$startdate."\r\nReturning Date: ".$enddate."\r\n\r\nPlease read the terms and condition before submitting the verification code"."\r\n\r\nTerms and Condition:"."\r\nI.\tDesignated Vehicle Information\r\n\tMake/Model:	2017 TOYOTA FORTUNER\r\n\tMotor No: 	".$motor."\r\n\tChassis No: 	".$chassis."\r\n\tColor: 		".$unit_color."\r\n\tPlate No:	".$plate_no."\r\nII.\tPeriod of Usage\r\n\tThe dates and time for use of the Vehicle will be:\r\n\tStart Date:  ".$startdate." --- End Date: ".$enddate."\r\nIII.\tMileage Limit\r\n\tMember-User will obey the following mileage limit for the Vehicle: \r\n\t[ ] No mileage limit		 [√ ] __________ kilometers "."\r\nIV.\tMember-User Fees\r\n\tThe Member-User hereby agrees to pay the Owner for use of the Vehicle as follows: \r\n\t1)	Fees: Php ___________per day / week. \r\n\t2)	Fuel: Member-User shall pay for the use of fuel. Whenever possible, the preferred fuel is TOTAL Excellium or its equivalent (Shell's V-Power Nitro+ and Petron's Turbo Diesel). Fuel refill receipts are required to be surrendered to the management for verification and recording purposes. \r\n\t3)	Extension rate per kilometer = Php 20.00\r\n\tExtension rate per hour = Php 400.00\r\n\tExtra charges will be charge beyond the allowable 10% of the estimated distance and daily rate.\r\n\t4)	Deposit: Php __________ \r\n\tOwner shall retain this deposit to be used, in the event of loss of or damage to the Vehicle during the term of this Agreement, to defray fully or partially the cost of necessary repairs or replacement. In the absence of damage or loss, said deposit shall be credited toward payment of the rental fee and any excess shall be returned to the Renter."."\r\nV.\tExisting Damage to Vehicle \r\n\tThe Parties acknowledge the existing damage to the Vehicle "."\r\nVI.\tInsurance\r\n\tThe Owner hereby warrants to Member-User that Owner possess car insurance that limits to Third Party Liability only. The Member-User is responsible for the basic excess on the policy."."\r\nVII.\tIndemnity\r\n\tRegardless of insurance coverage, Member-User shall fully indemnify the Owner for any loss, damage, and legal actions, including reasonable attorney’s fees that Owner suffers due to Member-User’s use of Vehicle during the term of this Agreement, including but not limited to, damage to the Vehicle, damage to the property of others, injury to Member-User, and injury to others. This provision survives the termination of this Agreement."."\r\nVIII.\tOwner Warranty\r\n\tThe Owner represents that to the best of his knowledge and belief that the Vehicle is in sound and safe condition and free of any known faults or defects that would affect its safe operation under normal use."."\r\nIX.\tMember-User Warranties\r\n\tThe Member-User agrees that Member-User will not:\r\n\ta)	use the Vehicle to carry any passengers other than requested for; \r\n\tb)	allow any other person to operate the Vehicle aside from the designated driver/s;\r\n\tc)	operate the Vehicle in violation of any laws or for an illegal purpose;\r\n\td)	use the Vehicle to push or tow another vehicle; \r\n\te)	use the Vehicle for any race or competition;\r\n\tf)	operate the vehicle in a negligent manner; and\r\n\tg)	entrust the vehicle ignition key to anyone."."\r\n\r\n\r\nThank you for patronizing the TBATMPC";
					if ($mail->send()){
						$errors = array();	
					}else{
						$errors[] = 'Error sending email...';
					}
				}
			}
			if (!empty($errors)){
				echo display_errors($errors);
			}else{
				echo 1;
			}
		}
	}

	if($_POST['key'] == 'reqsubmit'){
		$errno = array();
		$firstname = sanitize($_POST['firstname']);
		$lastname = sanitize($_POST['lastname']);
		$email = sanitize($_POST['email']);
		$address = sanitize($_POST['address']);
		$contactnumber = sanitize($_POST['contactnumber']);
		$unit_id = sanitize($_POST['unit']);
		$package = sanitize($_POST['package']);
		$startdate = sanitize($_POST['startdate']);
		$enddate = sanitize($_POST['enddate']);
		$days = sanitize($_POST['days']);
		$comment = sanitize($_POST['comment']);
		$inputcode = sanitize($_POST['inputcode']);
		$code = sanitize($_POST['code']);

		$unitQ = $db->query("SELECT * FROM van WHERE id = '$unit_id'");
		$unitR = mysqli_fetch_assoc($unitQ);
		$unit = $unitR['unit'];

		$sql_1 = $db->query("SELECT costperday FROM van WHERE unit = '$unit'");
		$result_1 = mysqli_fetch_assoc($sql_1);

		$output = array(
			'costperday' => $result_1['costperday'],
		);
		$bill = $code*$output['costperday'];

		if ($inputcode != $code){
			$errno[] = 'Wrong code';
		}else if ($inputcode == $code){
			$sql_2 = $db->query("SELECT start, end FROM events WHERE start = '$startdate' OR end = '$enddate'");
			if ($sql_2-> num_rows > 0){
				$errors[] = 'Conflict Schedule, please refer to the calendar provided.';
			}else{
				if (!empty($errno)){
					echo display_errors($errno);
				}else{
					$db->query("INSERT INTO rentalrequest (firstname, lastname, email, address, contactnumber, startdate, enddate, package, comment, van, code, noofdays) VALUES ('$firstname', '$lastname', '$email', '$address', '$contactnumber', '$startdate', '$enddate', '$package', '$comment', '$unit', '$code', '$days')");
					echo 1;
				}
			}
		}
	}

}
?>