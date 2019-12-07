<?php

if (isset($_POST['key'])) {
	$errors = array();

	$conn = new mysqli('localhost','root','','tbatmpc');

	require 'phpmailer/PHPMailerAutoload.php';



	if($_POST['key'] == 'codesubmit'){

			$firstname = $conn->real_escape_string($_POST['firstname']);
			$lastname = $conn->real_escape_string($_POST['lastname']);
			$email = $conn->real_escape_string($_POST['email']);
			$address = $conn->real_escape_string($_POST['address']);
			$contactnumber = $conn->real_escape_string($_POST['contactnumber']);
			$unit = $conn->real_escape_string($_POST['unit']);
			$package = $conn->real_escape_string($_POST['package']);
			$startdate = $conn->real_escape_string($_POST['startdate']);
			$enddate = $conn->real_escape_string($_POST['enddate']);
			$days = $conn->real_escape_string($_POST['days']);
			$comment = $conn->real_escape_string($_POST['comment']);
			$code = $conn->real_escape_string($_POST['code']);


			
				if ($firstname === '' || $lastname === '' || $email ==='' || $address ==='' || $contactnumber ==='' || $package ==='' || $startdate ==='' || $enddate ==='' || $unit ==='' || $package === '' || $days ==='') {
					exit('Fill all the required fields');
				}else{
					if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
			         	exit('Firstname Requires letters only');
			        }else{
			         	if (!preg_match("/^[a-zA-Z]*$/",$lastname)) {
			        		exit('Lastname Requires letters only'); 
			        	}else{
			        		if (strlen($contactnumber) < 11){
			       				exit('The cellphone number is invalid.');
			        		}
			        		if (strlen($contactnumber) > 11){
			       				exit('The cellphone number is invalid.');
			        		}else{
			        			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			         				exit('Email is not a valid email address.');
			        			}else{
			        				$sql = $conn->query("SELECT id FROM rentalrequest WHERE firstname = '$firstname' AND lastname = '$lastname' AND email = '$email' AND van = '$unit' AND package = '$package' AND startdate = '$startdate' AND enddate = '$enddate'");
									if ($sql-> num_rows > 0) {
										exit("Already exists!");
									}else{
										$sql = $conn->query("SELECT start, end FROM events WHERE start = '$startdate' OR end = '$enddate'");
										if ($sql-> num_rows > 0){
											exit('conflict');
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
												exit('year conflict');
											}else{
												if ($intsubenddate_month < $intsubstartdate_month && $intsubenddate_year <= $intsubstartdate_year){
													exit('month conflict');
												}else{
													if ($intsubenddate_day < $intsubstartdate_day && $intsubenddate_month <= $intsubstartdate_month && $intsubenddate_year <= $intsubstartdate_year){
														exit('day conflict');
													}else{
														$mail = new PHPMailer();

														$mail->isSMTP();
														$mail->Host = "smtp.gmail.com";
														$mail->SMTPSecure = "ssl";
														$mail->Port = 465;
														$mail->SMTPAuth = true;
														$mail->Username = 'edanogenesis028@gmail.com';
														$mail->Password = '09952916440watergreen';

														$mail->setFrom('edanogenesis028@gmail.com', 'Genesis Edano');
														$mail->addAddress($email);
														$mail->Subject = 'TBATMPC - Trusted Bliss Alliance of Transport Multi-Purpose Cooperative';
														$mail->Body = 'Hello '.$firstname.'!'.'
Good day. Here is your confirmation code: '.' '.' '.$code.', Kindly use this code to verify your request. Informations of your request as follows:'.'
'.
'Fullname: '.$firstname.' '.$lastname.'
'.
'Van: '.$unit.'
'.'Package: '.$package.'
'.'Pickup Point: '.$address.'
'.'Pickup Date: '.$startdate.'
'.'Returning Date: '.$enddate.'
'.'
'.'Thank you for patronizing the TBATMPC';

														if ($mail->send()){
														    exit('We sent a verification code on your email. Please encode the code here to verify your request');
														}else{
															exit();
														}
													}
												}
											}
										}		
									}	
			        			}
			         		}
			    		}
					}			
				}
			
		}

	if($_POST['key'] == 'reqsubmit'){

		$firstname = $conn->real_escape_string($_POST['firstname']);
		$lastname = $conn->real_escape_string($_POST['lastname']);
		$email = $conn->real_escape_string($_POST['email']);
		$address = $conn->real_escape_string($_POST['address']);
		$contactnumber = $conn->real_escape_string($_POST['contactnumber']);
		$unit = $conn->real_escape_string($_POST['unit']);
		$package = $conn->real_escape_string($_POST['package']);
		$startdate = $conn->real_escape_string($_POST['startdate']);
		$enddate = $conn->real_escape_string($_POST['enddate']);
		$days = $conn->real_escape_string($_POST['days']);
		$comment = $conn->real_escape_string($_POST['comment']);
		$inputcode = $conn->real_escape_string($_POST['inputcode']);
		$code = $conn->real_escape_string($_POST['code']);

		// $sql34 = $conn->query("SELECT * FROM code WHERE initial_code = '$inputcode' AND firstname = '$firstname'");
		// $result = $sql34->num_rows;
		// $yes = mysqli_fetch_all($sql34);
		// echo $yes;
		$sql = $conn->query("SELECT costperday FROM van WHERE unit = '$unit'");
		$result = mysqli_fetch_all($sql, MYSQLI_ASSOC);
		foreach($result as $row)
		{
			$output['costperday'] = $row['costperday'];
		}

		$bill = $code*$output['costperday'];


		if ($inputcode != $code){
			exit('wrong code');
		}else if ($inputcode == $code){
			$sql = $conn->query("SELECT id FROM rentalrequest WHERE firstname = '$firstname' AND lastname = '$lastname' AND email = '$email' AND van = '$unit' AND package = '$package' AND startdate = '$startdate' AND enddate = '$enddate' AND code = '$code'");
				if ($sql-> num_rows > 0) {
					exit("Already exists!");
				}else{
					$sql = $conn->query("SELECT start, end FROM events WHERE start = '$startdate' OR end = '$enddate'");
					if ($sql-> num_rows > 0){
					exit('conflict');
					}else{

						$conn->query("INSERT INTO rentalrequest (firstname, lastname, email, address, contactnumber, startdate, enddate, package, comment, van, code, noofdays) VALUES ('$firstname', '$lastname', '$email', '$address', '$contactnumber', '$startdate', '$enddate', '$package', '$comment', '$unit', '$code', '$days')");
						exit('Inserted');
					}
				}
		}
	}
}								

?>