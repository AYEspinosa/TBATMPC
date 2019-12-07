<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';
include ('../admin/includes/navigation.php');
if(!is_logged_in()){
		login_error_redirect();
}

$output = '';
$query = "SELECT * FROM package WHERE package_status = 'active'";
$statement = $db->query($query); 
while ($result = mysqli_fetch_assoc($statement)) {
  $output .= '<option value="'.$result['description'].'">'.$result["description"].'</option>';
}

$output2 = '';
$query = "SELECT * FROM van WHERE van_status = 'active'";
$statement2 = $db->query($query); 
while($result2 = mysqli_fetch_assoc($statement2))
{
  $output2 .= '<option value="'.$result2['id'].'">'.$result2["unit"].'</option>';
}


$sql = "SELECT id, title, start, end, color FROM events";
$req = $db->query($sql);
?>
<!DOCTYPE html>
<html>

	<head>
		<title>TBATMPC</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/glyphicons.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>

	<body>
    <!-- Page Content -->
    <div class="container-fluid colulu">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>TTS - Vehicle Schedule</h2><hr>
          
                <div id="calendar" class="col-centered">
                </div>
            </div>
			
        </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" action="addEvent.php">
				  		<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Add Event</h4>
					  	</div>
				  		<div class="modal-body">
					  		<div class="form-group">
								<label for="title" class="col-sm-2 control-label">Title</label>
								<div class="col-sm-10">
	            					<select name="title" class="form-control" id="title">
	              						<option value="">Choose</option>
	              						<?= $output2; ?>
	            					</select>
	          					</div>
					  		</div>
	          		  		<div class="form-group">
	          					<label for="package" class="col-sm-2 control-label">Package</label>
	          					<div class="col-sm-10">
	            					<select name="package" class="form-control" id="package">
	              						<option value="">Choose</option>
	              						<?= $output; ?>
	            					</select>
	          					</div>
	          		  		</div>
							<div class="form-group">
								<label for="color" class="col-sm-2 control-label">Color</label>
								<div class="col-sm-10">
								  	<select name="color" class="form-control" id="color">
										<option value="">Choose</option>
									  	<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
									  	<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
									  	<option style="color:#008000;" value="#008000">&#9724; Green</option>						  
									  	<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
									  	<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
									  	<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
									  	<option style="color:#000;" value="#000">&#9724; Black</option>  
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="start" class="col-sm-2 control-label">Start date</label>
								<div class="col-sm-10">
									<input type="text" name="start" class="form-control" id="start" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="end" class="col-sm-2 control-label">End date</label>
								<div class="col-sm-10">
									<input type="text" name="end" class="form-control" id="end" readonly>
								</div>
							</div>
					
				  		</div>
					  	<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
					  	</div>
					</form>
				</div>
			</div>
		</div>
		

		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" action="editEventTitle.php">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
						</div>
						<div class="modal-body">

							<div class="form-group">
								<label for="title" class="col-sm-2 control-label">Title</label>
								<div class="col-sm-10">
									<select name="title" class="form-control" id="title">
										<option value="">Choose</option>
										<?= $output2; ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="package" class="col-sm-2 control-label">Package</label>
								<div class="col-sm-10">
									<select name="package" class="form-control" id="package">
										<option value="">Choose</option>
										<?= $output; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="color" class="col-sm-2 control-label">Color</label>
								<div class="col-sm-10">
									<select name="color" class="form-control" id="color">
										<option value="">Choose</option>
										<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
										<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
										<option style="color:#008000;" value="#008000">&#9724; Green</option>						  
										<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
										<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
										<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
										<option style="color:#000;" value="#000">&#9724; Black</option>  
									</select>
								</div>
							</div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<div class="checkbox">
										<label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
									</div>
								</div>
							</div>

							<input type="hidden" name="id" class="form-control" id="id">


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>
<?php include '../admin/includes/footer_gen.php';?>
