<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({
      dateFormat:"yy-mm-dd"
    });
  } );
  </script>
</head>
<body>

  <div id=fontsignup class="container">
    <h1>Rental Request <font color=#ed0121> Form</font></h1>
  <div class="col-sm-6">
    <form action="register.php" method="post">
      <div class="form-group">
        <label for="firstname">First Name:</label>
        <input type="firstname" class="form-control" id="firstname" placeholder="Enter First Name" name="firstname">
      </div>
      <div class="form-group">
        <label for="lastname">Last Name:</label>
        <input type="lastname" class="form-control" id="lastname" placeholder="Enter Last Name" name="lastname">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
      <div class="form-group">
        <label for="contactnumber">Contact Number:</label>
        <input type="contactnumber" class="form-control" id="contactnumber" placeholder="Enter Contact Number" name="contactnumber">
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <input type="address" class="form-control" id="address" placeholder="Enter Address" name="address">
      </div>
      <div class="form-group">
        <label for="startdate">Start Date:</label>
        <input type="startdate" class="form-control datepicker" id="startdate" placeholder="Start Date" name="startdate">
      </div>
       <div class="form-group">
        <label for="enddate">End Date:</label>
        <input type="enddate" class="form-control datepicker" id="enddate" placeholder="End Date" name="enddate">
      </div>
      <button type="submit" class="btn btn-danger" name="reg_user">Send Request</button>
    </form><br>
  </div>
</div>
 
 
 
</body>
</html>