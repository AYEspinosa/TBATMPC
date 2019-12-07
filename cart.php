<?php
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/headerpartial.php';

if($cart_id != ''){
	$cartQ = $db->query("SELECT * FROM cart WHERE id = '$cart_id'");
	$results = mysqli_fetch_assoc($cartQ);
	$items = json_decode($results['items'], true);
	$i = 1;
	$sub_total = 0;
	$item_count = 0;

}
?>
<div class="col-md-12">
	<div class="row container-fluid cont">
		<h2 class="container-fluid text-center">My Shopping Cart<hr></h2>
		<?php if ($cart_id == '') : ?>
			<div class="container-fluid bg-danger text-white text-center">
				Your shopping cart is empty! <a href="shopping.php" class="text-white">Click here to shop now.</a>
			</div>
		<?php else: ?>
			<table class="table table-bordered table-condensed table-striped">
				<thead>
					<th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Size</th><th>Subtotal</th>
				</thead>
				<tbody>

					<?php
						foreach ($items as $item) {
							$product_id = $item['id'];
							$productQ = $db->query("SELECT * FROM products WHERE id = '$product_id'");

							$product = mysqli_fetch_assoc($productQ);
							$sizeArray = explode(',', $product['sizes']);
							foreach ($sizeArray as $sizeString) {
								$s = explode(':', $sizeString);
								if ($s[0] == $item['size']) {
									$available = $s[1];
								}
							}
					?>

					<tr>
						<td><?= $i; ?></td>
						<td><?= $product['title']; ?></td>
						<td><?= money($product['price']); ?></td>
						<td>
							<button class="btn btn-sm btn-default" onclick="update_cart('removeone', '<?= $product['id'];?>', '<?= $item['size']; ?>');">-</button>	
							&nbsp <?= $item['quantity']; ?> &nbsp
							<button class="btn btn-sm btn-default<?= (($item['quantity'] < $available)?'':' disabled');?>" onclick="update_cart('addone', '<?= $product['id'];?>', '<?= $item['size']; ?>');"<?= (($item['quantity'] < $available)?'':' disabled');?>>+</button>
						</td>
						<td><?= $item['size']; ?></td>
						<td><?= money($item['quantity'] * $product['price']); ?></td>
					</tr>	

					<?php 
							$i++;
							$item_count += $item['quantity'];
							$sub_total += ($product['price'] * $item['quantity']);
						}
						$tax = TAXRATE * $sub_total;
						$sub_total = $sub_total - $tax;
						$grand_total = $tax + $sub_total;
					?>
				</tbody>
			</table>
			<legend>Totals<hr></legend>
			<table class="table table-bordered table-condensed text-right">
				<thead class="text-center">
					<th>Total Items</th><th>Sub Total</th><th>Tax</th><th>Grand Total</th>
				</thead>
				<tbody>
					<tr>
						<td><?= $item_count; ?></td>
						<td><?= money($sub_total); ?></td>
						<td><?= money($tax); ?></td>
						<td class="td_lgreen"><?= money($grand_total); ?></td>
					</tr>
				</tbody>
			</table>
			<!-- Check out - Button trigger modal -->
			<div class="container-fluid">
				<div class="rt"></div>
				<button type="button" class="btn btn-sm btn-primary pull-left" onclick="get_zip_code(1)" style="float: right;">
				  <i class="fas fa-shopping-cart"></i> Check Out >>
				</button>
			</div>

			
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	function get_zip_code(dat){
		var data = {'id' : dat, 'total' : <?= $grand_total; ?>};
		jQuery.ajax({
			url : '/TBATMPC/includes/checkoutmodal.php',
			type : 'post',
			data : data,
			success : function(data){
				jQuery('body').append(data);
				jQuery('#checkoutModal').modal('toggle');
			},
			error: function(){
				alert("Something went wrong fetching zip code!");
			}
		});
	}

	function back_address(){
		jQuery('#payment-errors').html('');
		jQuery('#step1').css("display","block");
		jQuery('#step2').css("display","none");
		jQuery('#next_button').css("display","inline-block");
		jQuery('#back_button').css("display","none");
		jQuery('#checkout_button').css("display","none");
		jQuery('#checkoutModalLabel').html("Choose Payment Method:");
	}

	function code_check(){
		var data = {
			'f_code' : jQuery('#f_code').val(),
			'code' : jQuery('#code').val(),
		};
		jQuery.ajax({
			url : '/TBATMPC/admin/parsers/send_code.php',
			method : 'POST',
			data : data,
			success : function(resp){
				if (resp == 1){
					jQuery('#step1').css("display","none");
					jQuery('#step2').css("display","block");
					jQuery('#next_button').css("display","none");
					jQuery('#back_button').css("display","inline-block");
					jQuery('#checkout_button').css("display","inline-block");
					jQuery('#checkoutModalLabel').html("Choose Payment Method:");
					$('#codeModal').modal('hide');
				}else if(resp != 1){
					jQuery('#codeErr').html(resp);
				}
			},
			error : function(){},
		});
	}

	function check_address(){
		var data = {
			'code' : jQuery('#code').val(),
			'full_name' : jQuery('#full_name').val(), 
			'email' : jQuery('#email').val(),	
			'number' : jQuery('#number').val(),
			'street' : jQuery('#street').val(),
			'city' : jQuery('#city').val(),
			'zip_code' : jQuery('#zip_code').val(),
		};
		jQuery.ajax({
			url : '/TBATMPC/admin/parsers/check_address.php',
			method : 'post',
			data : data,
			success : function(data){
				if (data != 1) {
					jQuery('#payment-errors').html(data);
				}
				if (data == 1){
					jQuery('#payment-errors').html('');
					$('#codeModal').modal('show');
					// jQuery('#step1').css("display","none");
					// jQuery('#step2').css("display","block");
					// jQuery('#next_button').css("display","none");
					// jQuery('#back_button').css("display","inline-block");
					// jQuery('#checkout_button').css("display","inline-block");
					// jQuery('#checkoutModalLabel').html("Choose Payment Method:");
				}
			},
			error : function(){alert("Something Went Wrong!");}
		});
	}	
</script>

<?php include 'includes/footer.php';?>