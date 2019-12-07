</div>

		<footer class='text-center' id='footer'>
			&copy; Copyright 2013-<?= date('Y');?> TBATMPC 
		</footer>

		<script src="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script>
	    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	    <script type="text/javascript">
	    	function updateSizes(){
	    		var sizeString = "";
	    		for(var i=1;i<=12;i++){
	    			if(jQuery('#size'+i).val()!=''){
	    				sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+':'+jQuery('#threshold'+i).val()+',';
	    			}
	    		}
	    		jQuery('#sizes').val(sizeString);
	    	}

	    	function get_child_options(selected){
	    		if (typeof selected == 'undefined'){
	    			var selected = '';
	    		}
	    		var parentID = jQuery('#parent').val();
	    		jQuery.ajax({
	    			url: '/TBATMPC/admin/parsers/child_categories.php',
	    			type: 'POST',
	    			data: {parentID : parentID, selected : selected},
	    			success: function(data){
	    				jQuery('#child').html(data);
	    			},
	    			error: function(){alert('Something went wrong!!')}
	    		});
	    	}

	    	jQuery('select[name="parent"]').change(function(){
	    		get_child_options();
	    	});
	    </script>
	    
	</body>

</html>