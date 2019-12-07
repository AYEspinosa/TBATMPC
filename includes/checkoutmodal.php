<?php
	require_once('../core/init.php');
	$cityQ = $db->query("SELECT * FROM cities");
	$grand_total = sanitize($_POST['total']);
?>

			<?php ob_start(); ?>

			<!-- Credentials Modal -->
			<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="checkoutModalLabel">Shipping Address</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form action="thankyou.php" method="post" id="payment-form">
			        	<span class="bg-danger" id="payment-errors"></span>
			        	<div id="step1" class="step1">
			        		<div class="form-group col-md-6 indiv">
			        			<label for="full_name">Full Name:</label>
			        			<input type="text" name="full_name" class="form-control" id="full_name">
			        		</div>
			        		<div class="form-group col-md-6 indiv">
			        			<label for="email">Email:</label>
			        			<input type="email" name="email" class="form-control" id="email" placeholder="email@example.com">
			        		</div>
			        		<div class="form-group col-md-6 indiv">
			        			<label for="city">City:</label>
			        			<select name="city" id="city" class="form-control" onchange="myFunction()">
			        				<option value=""></option>
			        				<?php while($city = mysqli_fetch_assoc($cityQ)): ?>
				        				<option value="<?= $city['city']; ?>"> <?= $city['city']; ?></option>
			        				<?php endwhile; ?>
			        			</select>
			        		</div>
			        		<div class="form-group col-md-6 indiv">
			        			<label for="brgy">Barangay:</label>
			        			<select name="brgy" id="brgy" class="form-control">
			        				<option value="">Choose City First</option>
			        			</select>
			        		</div>
			        		<div class="form-group col-md-6 indiv">
			        			<label for="street">Street Address(House no., Street):</label>
			        			<input type="text" name="street" class="form-control" id="street" onkeyup="myFunction()">
			        		</div>
			        		<div class="form-group col-md-6 indiv">
			        			<label for="number" class="num_label">Contact Number:</label>
			        			<input type="text" name="head_num" class="form-control head_num" id="head_num" min="0" value="+63" readonly>
			        			<input type="number" name="number" class="form-control number" id="number" min="0">
			        		</div>
			        		<div class="form-group col-md-12 indiv">
			        			<label for="address">Address:</label>
			        			<input type="text" name="address" class="form-control" id="address" readonly>
			        		</div>
			        		<input style="width:40%; display:inline; visibility:hidden;" type="zip_code" class="form-control" id="zip_code" name="zip_code" value="">
			        	</div>
			        	<div id="step2" class="step2">
			        		<div class="form-group col-md-6 indiv text-center">
			        			<input type="radio" name="pay_meth" value="cash on delivery" id="cass on delivery">Cash on delivery 
			        		</div>
			        		<div class="form-group col-md-6 indiv text-center">
			        			<input type="radio" name="pay_meth" value="pick up" id="pick up" checked="checked">Pick Up
			        		</div>
			        		<div class="form-group col-md-12 text-center">
			        			<label for="total">Grand Total:</label>
			        			<input type="text" name="total" value="<?= number_format($grand_total, 2); ?>" id="total" class="form-control text-center" readonly>
			        		</div>
			        	</div>
		        	<div class="modal-footer">
		        		 <input style="width:40%; display:inline; visibility:hidden;" type="code" class="form-control" id="code" name="code" value="<?php $rand = (rand(1111111, 9999999)); 
					        	$code = $rand; echo $code; ?>">
					      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
					      <button type="button" class="btn btn-primary nixt btn-sm" onclick="check_address()" id="next_button">Next >></button>
					      <button type="button" class="btn btn-primary bick btn-sm" onclick="back_address()" id="back_button"><< Back</button>
					      <button type="submit" class="btn btn-primary chick btn-sm" id="checkout_button">Check Out</button>
					    </div>
				      </form>
				    </div>
			    </div>
			  </div>
			</div>

			<!-- Code Modal -->
			<div class="modal fade" id="codeModal" tabindex="-1" role="dialog" aria-labelledby="codeModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="codeModalLabel">Information</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			        <form action="" method="POST">
			        	<span class="bg-danger" id="codeErr"></span>
						<div class="modal-body form-group">
							<p><i>Please enter the code we sent to you via email.</i></p>
							<label for="f_code">Code:</label>
							<input type="text" name="code" id="f_code" class="form-control">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" onclick="code_check()">Submit</button>
						</div>
			        </form>
			    </div>
			  </div>
			</div>
			<script type="text/javascript">
				function myFunction()
			  	{
			        jQuery('#address').val(jQuery('#street').val() + ' ' + jQuery('#brgy').val() + ', ' + jQuery('#city').val() + ' ' + jQuery('#zip_code').val());
			  	}

			  	jQuery('select[name="brgy"]').change(function(){
			  		get_code();
			  	});

			  	function get_code(){
			  		var city = jQuery('#city').val();
		        	jQuery.ajax({
		        		url : '/TBATMPC/admin/parsers/code.php',
		        		method : 'POST',
		        		data : {'city' : city},
		        		success : function(zip){
		        			jQuery('#zip_code').val(zip);
		        			jQuery('#address').val(jQuery('#street').val() + ' ' + jQuery('#brgy').val() + ', ' + jQuery('#city').val() + ' ' + zip);
		        		},
		        		error : function(){},
		        	});
			  	}

		    	jQuery('select[name="city"]').change(function(){
		    		get_zip_codes();
		    	});

				function get_zip_codes(selected){
					if (typeof selected == 'undefined'){
		    			var selected = '';
		    		}
		    		var city_id = jQuery('#city').val();
		    		jQuery.ajax({
		    			url : '/TBATMPC/admin/parsers/zip_code.php',
		    			method : 'post',
		    			data : {'city_id' : city_id, 'selected' : selected},
		    			success : function(opts){
		    				jQuery('#brgy').html(opts);
		    			},
		    			error: function(){
		    				alert("Something went wrong fetching zip code!");
		    			}
		    		});
		    	}

			</script>

			<?php echo ob_get_clean(); ?>