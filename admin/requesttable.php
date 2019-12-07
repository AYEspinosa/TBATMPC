<?php
require '../send_email/phpmailer/PHPMailerAutoload.php';
require_once ($_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php');
include 'includes/navigation.php';
include 'includes/head_gen.php';
if(!is_logged_in()){
		login_error_redirect();
}
?>
		<br>
		<div class="container">
			<h2 align="center">Requests</h2>
			<div class=container-fluid>
				<div id="viewmodal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby='viewmodal' aria-hidden='true'>
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-title">Request Form</h2>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
							</div>

							<div class="modal-body border" style="">
								<div class="form-group col-md-12">
									<label for="firstname"> Full Name:</label><br>
									<input type="text" class="form-control" id="firstname" placeholder="Enter First Name" name="firstname" readonly>
								</div>

								<div class="form-group col-md-6 indiv">
									<label for="email">Email:</label><br>
									<input type="email" name="email" class="form-control" id="email" placeholder="Enter email" readonly>
								</div>
								<div class="form-group col-md-6 indiv">
									<label for="contactnumber">Contact Number:</label><br>
									<input type="number" class="form-control" id="contactnumber" placeholder="Enter Contact Number" name="contactnumber" readonly>
								</div>

								<div class="form-group col-md-12 indiv">
									<label for="address">Address:</label><br>
									<input type="address" class="form-control" id="address" placeholder="Enter Address" name="address" readonly>
								</div>

								<div class="form-group col-md-6 indiv">
									<label for="unit">Unit:</label><br>
									<input type="van" class="form-control" id="van" placeholder="" name="van" readonly>
								</div>
								<div class="form-group col-md-6 indiv">
									<label for="package">Package:</label><br>
									<input type="package" class="form-control" id="package" placeholder="" name="package" readonly>
								</div><br>

								<div class="form-group col-md-4 indiv">
									<label for="startdate">Pick-up Date:</label><br>
									<input type="startdate" class="form-control datepicker" id="startdate" placeholder="Start Date" name="startdate" readonly>
								</div>
								<div class="form-group col-md-4 indiv">
									<label for="enddate">Return Date:</label><br>
									<input type="enddate" class="form-control datepicker" id="enddate" placeholder="End Date" name="enddate" readonly>
								</div>
								<div class="form-group col-md-4 indiv">
									<label for="enddate">Days:</label><br>
									<input type="days" class="form-control" id="days" placeholder="days" name="days" readonly>
								</div><br>

								<div class="form-group col-md-12">
									<label for="comment">Comment:</label>
									<textarea class="form-control textarea" id="comment" placeholder="say something..." name="comment" value="comment" readonly></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>
			</div>

			<span id="alert_action"></span>
			<div class="row">
				<div class="col-lg-12 container-fluid">
					<div class="panel panel-default border">
						<div class="panel-heading">
							<div class="row">
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-6" style="margin-bottom: -20px;">
									<h4 class="panel-title">User List</h4>
								</div>
							</div>
							<hr>

						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-12 table-responsive">
									<table width="100%" id="user_data" class="table table-bordered table-striped table-condensed">
										<thead>
											<tr>
												<th>Name</th>
												<th>Requested Date</th>
												<th>Unit</th>
												<th>Comment</th>
												<th>Status</th>
												<th width="18.3%">Option</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
      
<script>
$(document).ready(function(){

	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add User");
		$('#action').val("Add");
		$('#btn_action').val("Add");
	});


	var userdataTable = $('#user_data').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax":{
			url:"requesttable_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"target":[4,5],
				"orderable":false
			}
		],
	});


	$(document).on('click', '.viewmodal', function(){
		var id = $(this).attr("id");
		var btn_action = 'fetch_single';
		jQuery.ajax({
			url:"requesttable_action.php",
			method:"POST",
			data:{id:id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				jQuery('#viewmodal').modal('toggle');
				jQuery('#firstname').val(data.firstname+' '+data.lastname);
				jQuery('#email').val(data.email);
				jQuery('#contactnumber').val(data.contactnumber);
				jQuery('#address').val(data.address);
				jQuery('#van').val(data.van);
				jQuery('#package').val(data.package);
				jQuery('#startdate').val(data.startdate);
				jQuery('#enddate').val(data.enddate);
				jQuery('#days').val(data.noofdays);
				jQuery('#comment').val(data.comment);
				jQuery('.modal-title').html("View Request");
				jQuery('#id').val(id);
			}
		});
	});


	$(document).on('click', '.accept', function(){
		var id = $(this).attr("name");
		var request_status = $(this).data('status');
		var btn_action = "accept";
		if(confirm("Are you sure you want to accept this request?"))
		{
			$.ajax({
				url:"requesttable_action.php",
				method:"POST",
				data:{id:id, request_status:request_status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
					userdataTable.ajax.reload();
				}
			})
		}
		else
		{
			return false;
		}
	});

	$(document).on('click', '.reject', function(){
		var id = $(this).attr("id");
		var request_status = $(this).data('status');
		var btn_action = "reject";
		if(confirm("Are you sure you want reject this request?"))
		{
			$.ajax({
				url:"requesttable_action.php",
				method:"POST",
				data:{id:id, request_status:request_status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
					userdataTable.ajax.reload();
				}
			})
		}
		else
		{
			return false;
		}
	});

});
</script>

<?php include 'includes/footer.php'; ?>
