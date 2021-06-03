<!DOCTYPE html>
<html lang="en">
<head>
  <title>8 VIEWS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
	    <div class="col-md-6">         
			<form>
			  <div class="form-group"> 
				<label for="email">Email</label>
				<input type="text" class="form-control" name="email" id="email" placeholder="Password">
			  </div>
			   <div class="form-group">
				<label for="Password">Password</label>
				<input type="password" class="form-control" name="password" id="password"  placeholder="Password">
			  </div>
		
			  <button id="submit" name="submit" type="submit" class="btn btn-primary">Login</button>
			</form> 
		</div>
	</div> 
</div>
</body>

<script>
$("#submit").click(function(e) {
	e.preventDefault();  

	 var email = $("#email").val();
	 var password = $("#password").val(); 
	 if(email==''||password=='') {
	 alert("Please fill all fields.");
	 return false;
	 }  
	 
	  $.ajax({
		 type: "POST",
		 url: "http://localhost/8views/v1/Login_api.php",
		 data: {
		 email: email,  
		 password: password
		 },  
		 cache: false,
		 success: function(data) { 
		 alert(data.message);      
		 localStorage.setItem('login', JSON.stringify(data.userdetails));
		 window.location.href = 'http://localhost/8views/views/dashboard.php'
		 },  
		 error: function(xhr, status, error) { 
		 var error = xhr.responseJSON;      
		 alert(error.message); 
		 }
		});  

})
</script>
</html>