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
			<h2 align="center">Packages</h2>
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
									<h4 class="panel-title">Package List</h4>
								</div>
							</div>
							<hr>
						</div>

						<div class="row">
							<div class="col-lg-12 table-responsive">
								<table width="100%" id="user_data" class="table table-bordered table-striped table-condensed">
									<thead>
										<tr>
											<th width="60%">ID</th>
											<th width="60%">Name</th>
											<th width="60%">Description</th>
											<th width="60%">Status</th>
											<th width="60%">Options</th>
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
								<h4 class="modal-title"><i class="fa fa-plus"></i> Add Package</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Enter Name</label>
									<input name="package" id="package" class="form-control" required />
								</div>
								<div class="form-group">
									<label>Enter Description</label>
									<input name="description" id="description" class="form-control" required />
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
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Package");
		$('#action').val("Add");
		$('#btn_action').val("Add");
	});

	var userdataTable = $('#user_data').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax":{
			url:"package_fetch.php",
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
			url:"package_action.php",
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
			url:"package_action.php",
			method:"POST",
			data:{id:id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#package').val(data.name);
				$('#description').val(data.description);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Package");
				$('#id').val(id);
				$('#action').val('Edit');
				$('#btn_action').val('Edit');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var package_status = $(this).data('status');
		var btn_action = "delete";
		if(confirm("Are you sure you want to change status?"))
		{
			$.ajax({
				url:"package_action.php",
				method:"POST",
				data:{id:id, package_status:package_status, btn_action:btn_action},
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
				url:"package_action.php",
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

		</div>
	</body>
</html>


