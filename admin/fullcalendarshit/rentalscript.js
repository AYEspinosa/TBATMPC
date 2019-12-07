

$( function() {
    $( ".datepicker" ).datepicker({
      dateFormat:"yy-mm-dd"
    });
  } );

function requestrental(key) {
		var firstname = $("#firstname");
		var lastname = $("#lastname");
		var email = $("#email");
		var address = $("#address");
		var contactnumber = $("#contactnumber");
		var unit = $("#unit");
		var package = $("#package");
		var startdate = $("#startdate");
		var enddate = $("#enddate");
		var comment = $("#comment");

		
		$.ajax({
			url: 'rentalajax.php',
			method: 'POST',
			dataType: 'text',
			data: {
				key: key,
				firstname: firstname.val(),
				lastname: lastname.val(),
				email: email.val(),
				address: address.val(),
				contactnumber: contactnumber.val(),
				unit: unit.val(),
				package: package.val(),
				startdate: startdate.val(),
				enddate: enddate.val(),
				comment: comment.val()

			}, success: function (response) {
				alert(response);

			}

		});
	}	

	