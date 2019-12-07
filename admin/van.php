<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php');
include 'includes/navigation.php';
include 'includes/head_gen.php';
if(!is_logged_in()){
	login_error_redirect();
}

?>

		<br>
		<div class="container">
			<h2 align="center">Cars</h2>
			<div class="pull-right">
				<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-sm">Add</button>
			</div>
			<br><br>
			<span id="alert_action"></span>
			<div class="row">
				<div class="col-lg-12 container-fluid">
					<div class="panel panel-default border">
						<div class="panel-heading">
							<div class="row">
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-6" style="margin-bottom: -20px;">
									<h4 class="panel-title">Cars List</h4>
								</div>
							</div><hr>
						</div>
						<div class="panel-body">
							<div class="row"><div class="col-sm-12 table-responsive">
								<table width="100%" id="user_data" class="table table-bordered table-striped table-condensed">
									<thead>
										<tr>
											<th>ID</th>
											<th>Make/Model</th>
											<th>Rate</th>
											<th>Description</th>
											<th>Chassis No.</th>
											<th>Plate No.</th>
											<th>Motor No.</th>
											<th>Status</th>
											<th width="10%">Options</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="userModal" class="modal fade">
				<div class="modal-dialog">
					<form method="post" id="user_form">
						<div class="modal-content">
							<div class="modal-header">

								<h4 class="modal-title"><i class="fa fa-plus"></i> Add Unit</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Enter Unit</label>
									<input name="unit" id="unit" class="form-control" required />
								</div>
								<div class="form-group">
									<label>Enter Rent Rate</label>
									<input name="rentrate" id="rentrate" class="form-control" required />
								</div>
								<div class="form-group">
									<label>Enter Description</label>
									<input name="description" id="description" class="form-control" required />
								</div>
								<div class="form-group">
									<label>Enter Chassis No.</label>
									<input name="Chassis" id="Chassis" class="form-control" required />
								</div>
								<div class="form-group">
									<label>Enter Plate No.</label>
									<input name="Plate" id="Plate" class="form-control" required />
								</div>
								<div class="form-group">
									<label>Enter Motor No.</label>
									<input name="Motor" id="Motor" class="form-control" required />
								</div>												
							</div>
							<div class="modal-footer">
								<input type="hidden" name="id" id="id" />
								<input type="hidden" name="btn_action" id="btn_action" />
								<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</form>

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
			url:"van_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"target":[4,5],
				"orderable":false
			}
		],
	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url:"van_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#user_form')[0].reset();
				$('#userModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				userdataTable.ajax.reload();
			}
		})
	});

	$(document).on('click', '.update', function(){
		var id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"van_action.php",
			method:"POST",
			data:{id:id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#unit').val(data.unit);
				$('#rentrate').val(data.rentrate);
				$('#description').val(data.description);
				$('#Chassis').val(data.Chassis);
				$('#Plate').val(data.Plate);
				$('#Motor').val(data.Motor);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit User");
				$('#id').val(id);
				$('#action').val('Edit');
				$('#btn_action').val('Edit');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var van_status = $(this).data('status');
		var btn_action = "delete";
		if(confirm("Are you sure you want to change status?"))
		{
			$.ajax({
				url:"van_action.php",
				method:"POST",
				data:{id:id, van_status:van_status, btn_action:btn_action},
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

	$(document).on('click', '.change', function(){
		var id = $(this).attr("id");
		var btn_action = "change";
		if(confirm("Delete?"))
		{
			$.ajax({
				url:"van_action.php",
				method:"POST",
				data:{id:id, btn_action:btn_action},
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


