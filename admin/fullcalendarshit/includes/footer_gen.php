</div>

		<footer class='text-center' id='footer'>
			&copy; Copyright 2013-<?= date('Y');?> TBATMPC 
		</footer>

		<script src="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script>
	    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	    <!-- /.container -->
	    <script src="js/jquery.js"></script>
	    <script src="js/bootstrap.min.js"></script>
		<script src='../js_cal/moment.min.js'></script>
		<script src='../js_cal/fullcalendar.min.js'></script>
	    <script type="text/javascript">
	    	function updateSizes(){
	    		var sizeString = "";
	    		for(var i=1;i<=12;i++){
	    			if(jQuery('#size'+i).val()!=''){
	    				sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
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

			$(document).ready(function() {
				
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next ',
						center: 'title',
						right: 'month'
					},
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					selectable: true,
					selectHelper: true,
					select: function(start, end) {
						
						$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd').modal('show');
					},
					eventRender: function(event, element) {
						element.bind('dblclick', function() {
							$('#ModalEdit #id').val(event.id);
							$('#ModalEdit #title').val(event.title);
							$('#ModalEdit #color').val(event.color);
							$('#ModalEdit #package').val(package);
							$('#ModalEdit').modal('show');
						});
					},
					eventDrop: function(event, delta, revertFunc) { // si changement de position

						edit(event);

					},
					eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

						edit(event);

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
				
				function edit(event){
					start = event.start.format('YYYY-MM-DD HH:mm:ss');
					if(event.end){
						end = event.end.format('YYYY-MM-DD HH:mm:ss');
					}else{
						end = start;
					}
					
					id =  event.id;
					
					Event = [];
					Event[0] = id;
					Event[1] = start;
					Event[2] = end;
					
					$.ajax({
					 url: 'editEventDate.php',
					 type: "POST",
					 data: {Event:Event},
					 success: function(rep) {
							if(rep == 'OK'){
								alert('Saved');
							}else{
								alert('Could not be saved. try again.'); 
							}
						}
					});
				}
			
			});
		</script>
	</body>

</html>