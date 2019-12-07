<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TBATMPC/core/init.php';
include 'includes/head_gen.php';
include 'includes/headerpartial.php';


$sql = "SELECT id, title, start, end, color FROM events ";
$req = $db->query($sql);
$events = mysqli_fetch_assoc($req);

$output = '';
$query = "SELECT * FROM package WHERE package_status = 'active'";
$statement = $db->query($query);  

while($result = mysqli_fetch_assoc($statement))
{
  $output .= '<option value="'.$result['description'].'">'.$result["description"].'</option>';
}

$output2 = '';
$query = "SELECT * FROM van WHERE van_status = 'active'";
$statement = $db->query($query);

while($result = mysqli_fetch_assoc($statement))
{
  $output2 .= '<option value="'.$result['id'].'">'.$result["unit"].'</option>';
}
?>
    <style>
    body{
    	margin-top: -20px;
    	padding-top: 20px;
    }
    #button{
    	margin:20px;
    }
	#blackmessage {
		background-color:black;
		height:73px;
		padding-bottom: 90px;
	}  
	#hen {
		color:whitesmoke;
		text-align: center;
		vertical-align: text-bottom;
	}
	.grandia{
		padding-top:90px;
	}
	#calendar {
		max-width: 600px;
	}
	.calendar{
		background-color:#f5f5f0;
		border-radius:15px;
		border: solid 3px #f2f2f2;
		box-shadow: 5px 5px 2px grey;
	}
	.col-centered{
		float: none;
	}
	.buttonextra {
		left:-200px;
	}

    </style>


</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<a class="navbar-brand" href="index.php" style="margin-left: 10%; color: black;">Mang Boni Total Car Care Supplies</a>
			<ul class="nav navbar-nav mr-auto" style="padding-left: 30%;">
				<li class="nav-item active">
  					<a class="nav-link" href="index.php" style="color: black;">Home
    					<span class="sr-only">(current)</span>
  					</a>
	            </li>
	            <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="about.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
			         About<i class="fas fa-caret-down"></i>
			        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="padding-left: 20%;">
				          <a class="dropdown-item" href="about.php" style="color: black;">Our Cooperative</a>
						</div>
			    </li>
	            <li class="nav-item">
	             	<a class="nav-link" href="shopping.php" style="color: black;">Shop Now</a>
	            </li>
	            <li class="nav-item">
	             	<a class="nav-link" href="indexforuser.php" style="color: black;">Rent A Car</a>
	            </li>
			</ul>
		</div>
	</nav>

<div id ="blackmessage" class="container-fluid">
	<br><div id="hen"><h2>The Best Vehicle Rental Service in Baguio City</h2></div>
</div>
<button type="button" id="button" class="btn btn-primary" data-toggle="modal" data-target="#addbuttonmodal">Reservation Form</button>	

<div class="container">
	<div id=br class="col-lg-6">
		<img class="img img-responsive grandia" src="grandia.png" alt="grandia" />
		<!-- <img class="img img-responsive img-thumbnail" src="grandia2.jpg" alt="grandia" /> -->
	</div>
	<div class="col-lg-6">
		
			<h2><font color=#262626><b>&nbspTOYOTA</b></font> <font color=red><b>GRANDIA</b></font></h2>
			<div class="container-fluid">            
				<p><br>
					Get the best out of your travel. Experience to ride the latest SUV's in the market. Rent our Toyota Fortuner now, with or withour a driver.
				</p>
			</div><br>
			<div class="container-fluid">            
				<table class="col-sm-12 table table-responsive table-bordered table-striped" style="box-shadow: 5px 5px 2px grey;">
					<tr>
						<td><b>Make</b></td>
						<td>Toyota</td>
					<tr>
					<tr>
						<td><b>Model</b></td>
						<td>Grandia</td>
					<tr>
					<tr>
						<td><b>Capacity</b></td>
						<td>10 persons</td>
					<tr>
					<tr>
						<td><b>Gas</b></td>
						<td>Diesel</td>
					<tr>
					<tr>
						<td><b>Transmission</b></td>
						<td>Automatic</td>
					<tr>
					<tr>
						<td><b>Rental Cost</b></td>
						<td>7500PHP self drive</td>
					<tr>																			
				</table>
			</div>
	</div>	


</div><br><br><br>
<div class="container">
	<div id=br class="col-lg-6">
		<img class="img img-responsive grandia" src="fortuner.png" alt="fortuner" />
		<!-- <img class="img img-responsive img-thumbnail" src="grandia2.jpg" alt="grandia" /> -->
	</div>
	<div class="col-lg-6">
		
			<h2><font color=#262626><b>&nbspTOYOTA</b></font> <font color=red><b>FORTUNER</b></font></h2>
			<div class="container-fluid">            
				<p><br>
					Get the best out of your travel. Experience to ride the latest Van in the market. Rent our Toyota Hiace GL Grandia now, with or withour a driver.
				</p>
				
			</div><br>
			<div class="container-fluid">            
				<table class="col-sm-12 table table-responsive table-bordered table-striped" style="box-shadow: 5px 5px 2px grey;">
					<tr>
						<td><b>Make</b></td>
						<td>Toyota</td>
					<tr>
					<tr>
						<td><b>Model</b></td>
						<td>Fortuner</td>
					<tr>
					<tr>
						<td><b>Capacity</b></td>
						<td>7 persons</td>
					<tr>
					<tr>
						<td><b>Gas</b></td>
						<td>Diesel</td>
					<tr>
					<tr>
						<td><b>Transmission</b></td>
						<td>Automatic</td>
					<tr>
					<tr>
						<td><b>Rental Cost</b></td>
						<td>5500PHP self drive</td>
					<tr>																			
				</table>
			</div>
	</div>		
</div><br><br><br><br><br><br>

<div id="aboutus" class="light-wrapper" style="background-color:whitesmoke; padding:80px; border-top: solid #d6d6c2; border-bottom: solid #d6d6c2">
    <div class="container inner">
        <h2 class="section-title text-center">RESERVATION <font color=#ed0121>GUIDE</font></h2>
       <br><br>
        <div class="row text-center">
            <div class="col-lg-4">
                <div class="col-wrapper">
                    <div class="icon-wrapper"> <i class="fa fa-flag fa-5x"></i> </div>
                    <h3>Reservation <font color=#ed0121>Form</font></h3>
                    <p>Fill up the reservation form and wait for an email message with the verification code.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-wrapper">
                    <div class="icon-wrapper"> <i class="fa  fa-envelope fa-5x"></i> </div>
                    <h3>Verification <font color=#ed0121;>Code</font></h3>
                    <p>Wait for an email with the verification code to verify your request. Type the code in the space provided</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-wrapper">
                    <div class="icon-wrapper"> <i style="color:#ed0121" class="fa fa-check fa-5x"></i> </div>
                    <h3>Confirmation</h3>
                    <p>Wait for an email confirmation for your request. </p>
                </div>
            </div>
        </div> 
    </div>
</div>

<div class=container-fluid>
	  <div id="addbuttonmodal" class="modal fade container-fluid" role="dialog">
	    <div class="modal-dialog modal-lg">
	    <form id="form1">	
	      <div class="modal-content">
	        <div class="modal-header">
	          <h2 class="modal-title">Request Form</h2>
	        </div>
	        <span id="req-errors" class="bg-danger"></span>
	        <div class="modal-body">
	          <div class="container-fluid">
	          <label for="firstname"> First Name:</label>
	          <input style="width:39%; display:inline;" type="firstname" class="form-control" id="firstname" placeholder="Enter First Name" name="firstname">

	          <label for="firstname"> Last Name:</label>
	          <input style="width:39%; display:inline;" type="lastname" class="form-control" id="lastname" placeholder="Enter Last Name" name="lastname">
	          </div><br>

	          <div class="container-fluid">
	          <label for="email">Email:</label>
	          <input style="width:42%; display:inline;" type="email" class="form-control" id="email" placeholder="Enter email" name="email">
	          <label for="contactnumber">Contact Number:</label>
	          <input style="width:36%; display:inline;" type="contactnumber" class="form-control" id="contactnumber" placeholder="Enter Contact Number" name="contactnumber">
	          </div><br>

	          <div class="container-fluid">
	          <label for="address">Address:</label>
	          <input style="width:90.5%; display:inline;" type="address" class="form-control" id="address" placeholder="Enter Address" name="address"><br><br>
	      	  </div>

	          <div class="container-fluid">
	          <label for="unit">Unit:</label>
	          <select style="width:43%; display:inline;" name="unit" class="form-control" id="unit" type="unit">
	                <option value="">Choose Van Unit</option>
	                <?php echo $output2; ?>
	          </select>
	          <label for="package">Package:</label>
	          <select style="width:42.5%; display:inline;" name="package" class="form-control" id="package" type="package">
	                <option value="">Choose Package</option>
	                <?php echo $output; ?>
	          </select> 
	          </div><br>

	          <div class="container-fluid">
	          <label for="startdate">Pick-up Date:</label>
	          <input style="width:22%; display:inline;" type="startdate" class="form-control datepicker" id="startdate" placeholder="Start Date" name="startdate">
	          <label for="enddate">Return Date:</label>
	          <input style="width:22%; display:inline;" type="enddate" class="form-control datepicker" id="enddate" placeholder="End Date" name="enddate">
	          <label for="days">Number of Days:</label>
	          <input style="width:17.5%; display:inline;" type="number" class="form-control" id="days" placeholder="days" name="days">
	          </div><br>

	          <div class="container-fluid">
	          <label for="comment">Comment:</label>
	          <textarea style="width:98%" class="form-control textarea" id="comment" placeholder="say something..." name="comment" value="comment"></textarea>
	          </div>
	        </div>
	        <input style="width:40%; display:inline; visibility:hidden;" type="code" class="form-control" id="code" name="code" value="<?php $rand = (rand(1111111, 9999999)); 
	        	$code = $rand; echo $code; ?>">

	        <div class="modal-footer">
	          <input type="button" onclick="codemodal('codesubmit')" value="Submit" class="btn btn-success">
	        </div>
	      </div>
	  </form>
	    </div>
	  </div>
	  <br>
 </div>

 <div class=container-fluid>


	  <div id="codemodal" class="modal fade container-fluid" role="dialog">
	    <div class="modal-dialog modal-md">
	    <form id="form2">	
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4>By entering the code, you have agreed to our terms and condition</h4>	
	          <div class="modal-title"><b>Verification Code:</b></div>
	        </div>
	        <span id="code-req" class="bg-danger"></span>

	        <div class="modal-body">

	         
	          <div class="container-fluid">
	          <label for="code"> Code:</label>
	          <input style="width:46%; display:inline;" type="code" class="form-control" id="inputcode" placeholder="code" name="inputcode">
	          </div><br>


	        <div class="modal-footer">
	          <input type="button" onclick="requestrental('reqsubmit')" value="Submit" class="btn btn-success">
	        </div>
	      </div>
	    </div>
	</form>
	  </div>
	  <br>
 </div><br><br>
	

    <!-- Page Content -->
    <div class="container">

        <div class="row">
        	<div class="col-lg-6">
        		<br><br><br><br><br><br><br><br>
        		<p style="font-size:20px">Refer to this calendar to see the availability of our cars.</p><br>
        		
        	</div>

            <div class="col-lg-6 text-center calendar">
                <h2></h2>
                <div id="calendar" class="col-centered"></div>
            	
            </div>
			
        </div>
        <br><br><br><br><br><br>

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
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
					</div>
				  </div>
				  <div class="form-group">
					<label for="Package" class="col-sm-2 control-label">Package</label>
					<div class="col-sm-10">
					  <select name="Package" class="form-control" id="color">
						  <option value="">Choose</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; VAN1 Package 1</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; VAN1 Package 2</option>
						  <option style="color:#008000;" value="#008000">&#9724; VAN1 Package 3</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; VAN2 Package 1</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; VAN2 Package 2</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; VAN2 Package 3</option>  
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
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
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
    <!-- /.container -->



    

    <!-- Bootstrap Core JavaScript -->
    <script src="js_cal/bootstrap.min.js"></script>
	<script src='js_cal/moment.min.js'></script>
	<script src='js_cal/fullcalendar.min.js'></script>
	
	<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: '',
				center: 'title',
				right: 'prev,next '
			},
			events: [
			<?php while ($events = mysqli_fetch_assoc($req)):
				$start = explode(" ", $events['start']);
				$end = explode(" ", $events['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $events['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $events['end'];
				}
			?>
			{
				id: '<?= $events['id']; ?>',
				title: '<?= $events['title']; ?>',
				start: '<?= $start; ?>',
				end: '<?= $end; ?>',
				color: '<?= $events['color']; ?>',
				
			},	
			<?php 
				endwhile;
			?>
			]
		});
		
		
	});

	$( function() {
    $( ".datepicker" ).datepicker({
      dateFormat:"yy-mm-dd"
    });
  } );

function requestrental(key) {
	var code = $("#code");
	var inputcode = $("#inputcode");
    var firstname = $("#firstname");
    var lastname = $("#lastname");
    var email = $("#email");
    var days = $("#days");
    var address = $("#address");
    var contactnumber = $("#contactnumber");
    var unit = $("#unit");
    var package = $("#package");
    var startdate = $("#startdate");
    var enddate = $("#enddate");
    var comment = $("#comment");

    
    $.ajax({
      url: 'rental_ajax.php',
      method: 'POST',
      dataType: 'text',
      data: {
        key: key,
        code: code.val(),
        inputcode: inputcode.val(),
        firstname: firstname.val(),
        lastname: lastname.val(),
        email: email.val(),
        address: address.val(),
        days: days.val(),
        contactnumber: contactnumber.val(),
        unit: unit.val(),
        package: package.val(),
        startdate: startdate.val(),
        enddate: enddate.val(),
        comment: comment.val()

      }, success: function (flag) {
      	if (flag == 1){
			jQuery('#req-errors').html('');
        	alert("Your Request is now under evaluation, thank you!");
	        $('#form2')[0].reset();
	        $('#codemodal').modal('hide');
        }else{
			jQuery('#req-errors').html(flag);
        }

      }

    });
  } 
  $('#addbuttonmodal').on('hidden.bs.modal', function(e)
    { 
        $('#form1')[0].reset();
    }) ;

  function codemodal(key) {
  	var code = $("#code");
    var firstname = $("#firstname");
    var lastname = $("#lastname");
    var email = $("#email");
    var address = $("#address");
    var days = $("#days");
    var contactnumber = $("#contactnumber");
    var unit = $("#unit");
    var package = $("#package");
    var startdate = $("#startdate");
    var enddate = $("#enddate");
    var comment = $("#comment");

    
    $.ajax({
      url: 'rental_ajax.php',
      method: 'POST',
      dataType: 'text',
      data: {
      	key: key,
      	code:code.val(),
        firstname: firstname.val(),
        lastname: lastname.val(),
        email: email.val(),
        address: address.val(),
        days: days.val(),
        contactnumber: contactnumber.val(),
        unit: unit.val(),
        package: package.val(),
        startdate: startdate.val(),
        enddate: enddate.val(),
        comment: comment.val()
      }, success: function (flag) {
      	if (flag != 1) {
			jQuery('#req-errors').html(flag);
		}else if(flag == 1){
			jQuery('#req-errors').html('');
        	$('#codemodal').modal('show');
        }
      }, error: function(response){
      	alert(response);
      }

    });

    
  }
 

</script>
<?php include 'includes/footer.php'; ?>