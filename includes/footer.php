</div>

		<footer class='text-center' id='footer'>
			&copy; Copyright 2013-<?= date('Y');?> TBATMPC 
		</footer>


		<script type="text/javascript">
			jQuery(window).scroll(function(){
				var vscroll = jQuery(this).scrollTop();
				jQuery("#logotxt").css({
					"transform" : "translate(0px, "+vscroll/1.970+"px)"
				});
			});

			function detailsmodal(id){	
				var data = {"id": id};
				jQuery.ajax({
					url: '/TBATMPC/includes/detailsmodal.php',
					method: "POST",
					data: data,
					success: function(data){
						jQuery('body').append(data);
						jQuery('#details-modal').modal('toggle');
					},
					error: function(){
						alert('Something went wrong!');
					}
				});
			}

			function update_cart(mode,edit_id, edit_size){
				var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
				jQuery.ajax({
					url: '/TBATMPC/admin/parsers/update_cart.php',
					method: 'post',
					data: data,
					success : function(){
						location.reload();
					},
					error : function(){alert("Something went wrong!");}
				});
			}

			function add_to_cart(){
				jQuery("#modal_errors").html("");
				var size = jQuery("#size").val();
				var quantity = parseInt(jQuery("#quantity").val());
				var available = parseInt(jQuery("#available").val());
				var error = "";
				var data = jQuery("#add_product_form").serialize();
				
				if((size == '' || size <= 0) && (quantity == '' || quantity <= 0)){
					error += "<p class='text-white text-center'>You must choose a valid size and quantity.</p>";
					jQuery('#modal_errors').html(error);
					return;
				}else if(size == '' || size <= 0){
					if(quantity == '' || quantity <= 0){
						error += "<p class='text-white text-center'>You must choose a valid size and quantity.</p>";
						jQuery('#modal_errors').html(error);
						return;
					}else{
						error += "<p class='text-white text-center'>You must choose a size.</p>";
						jQuery('#modal_errors').html(error);
						return;
					}
				}else if(quantity > available){
					error += "<p class='text-white text-center'>There are only "+ available +" available.</p>";
					jQuery('#modal_errors').html(error);
					return;
				}else if(quantity == '' || quantity <= 0){
					error += "<p class='text-white text-center'>You must choose enter a valid quantity.</p>";
					jQuery('#modal_errors').html(error);
					return;
				}else{
					jQuery.ajax({
						url : '/TBATMPC/admin/parsers/add_cart.php',
						method : 'POST',
						data: data,
						success : function(){
							alert("Added to your cart!");
							closeModal();
							location.reload();
						},
						error : function(){alert("Something went wrong!");}
					});
				}
			}

		</script>
		<script src="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script>
	    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	</body>

</html>