<?php
	require_once('../core/init.php');
	$id = $_POST['id'];
	$id = (int)$id;
	$result = $db->query("SELECT * FROM products WHERE id = '$id'");
	$product = mysqli_fetch_assoc($result);
	$brand_result = $db->query("SELECT brand FROM brand WHERE id =".$product['brand']);
	$brand = mysqli_fetch_assoc($brand_result);
	$size_string = $product['sizes'];
	$size_array = explode(',', $size_string);
?>
		<!-- Details Modal -->
		<?php ob_start(); ?>
		<div class='modal fade details-1' id='details-modal' tabindex='-1' role='dialog' aria-labelledby='details-1' aria-hidden='true'>
			<div class="modal-dialog modal-lg">
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title text-center'> <?= $product['title']; ?> </h4>
						<button class='close' type='button' onclick="closeModal()" aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
					</div>
					<div class='modal-body'>
						<div class='container-fluid'>
							<div class="bg-danger text-center" id="modal_errors"></div>
							<div class='row'>
								<div class='col-sm-6 fotorama'>
									<?php $photos = explode(",", $product['image']);
									foreach ($photos as $photo) : ?>
											<img src="<?= $photo; ?>" alt="<?= $product['title']; ?>" class='details img-responsive'>
									<?php endforeach; ?>
								</div>
								<div class='col-sm-6'>
									<h4>Details</h4>
									<p><?= nl2br($product['description']); ?></p><hr>
									<b><p>Price:</b> ₱<?= $product['price']; ?></p>
									<b><p>Brand:</b> <?= $brand['brand']; ?></p>
									<form action='add_cart.php' method='POST' id="add_product_form">
										<input type="hidden" name="available" id="available" value="">
										<input type="hidden" name="product_id" value="<?= $id; ?>">
										<div class='form-group'>
											<div class='col-xs-3'>
												<label for='quantity'><b>Quantity:</b></label>
												<input type='number' class='form-control' id='quantity' name='quantity' min="0" value="1" class="quantity">
											</div>
										</div>
										<div class='form-group'>
											<label for='size'><b>Size:</b></label>
											<select name='size' id='size' class='form-control'>
												<option value=''></option>
												<?php foreach ($size_array as $string) {
													$string_array = explode(':', $string);
													$size = $string_array[0];
													$available = $string_array[1];
													if ($available > 0){
														echo "<option value='".$size."' data-available='".$available."'>".$size." (Available: ".$available.")</option>";
													}
												}
												?>
											</select>
										</div>
									</form> 
								</div>
							</div>
						</div>
					</div>
					<div class='modal-footer'>
						<button class='btn btn-default' onclick="closeModal()">Close</button>
						<button class='btn btn-warning' onclick="add_to_cart(); return false;"><span class='fas fa-shopping-cart'></span>&nbsp;Add to Cart</button>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('input').on('keypress', function (event) {
			    var regex = new RegExp("^[a-zA-Z0-9]+$");
			    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			    if (!regex.test(key)) {
			       event.preventDefault();
			       return false;
			    }
			});

			jQuery('#size').change(function(){
				var available = jQuery('#size option:selected').data('available');
				jQuery('#available').val(available);
			});

			$(function () {
			  $('.fotorama').fotorama({'loop' : true, 'autoplay' : true});
			});
			function closeModal(){
				jQuery('#details-modal').modal('hide');
				setTimeout(function(){
					jQuery('#details-modal').remove();
					jQuery('.modal-backdrop').remove();
				},500);
			}
		</script>
		<?php echo ob_get_clean(); ?>