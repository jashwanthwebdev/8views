

<!DOCTYPE html>
<html lang="en">
<head>
  <title>8 VIEWS TASK</title> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container">
  <h2>Name : <span id='getname'></span></h2>  
     <div class="container" id="showForm" style="display:none">
    <div class="row"> 
	    <div class="col-md-6">         
			<form>
			  <div class="form-group">
				<label for="name">Name</label> 
				<input type="text" class="form-control" name="name" id="name"  placeholder="Enter email">
				
			  </div>
			  <div class="form-group"> 
				<label for="email">Email</label>
				<input type="text" class="form-control" name="email" id="email" placeholder="Password">
			  </div> 
			   <div class="form-group" style="display:none"> 
				<input type="hidden" class="form-control" name="Rid" id="Rid" placeholder="Password">
			  </div> 
			   <div class="form-group"> 
				<label for="exampleInputPassword1">Role</label>
				<select class="form-control" name="role" id="role"> 
				    <option value="Admin">Admin</option>
					<option value="Viewer">Viewer</option>  
					<option value="Editor">Editor</option> 
				</select>
			  </div>
			  <button id="update" name="submit" type="submit" class="btn btn-primary">UPDATE</button>
			</form> 
		</div>    
	</div> 
</div>
  <table class="table">  
    <thead> 
      <tr>
        <th>Name</th>
        <th>Email</th>  
        <th>Role</th> 
		<th>Action</th>   
      </tr>  
    </thead> 
    <tbody id="getUser">
    
      <tr>
        <td>JASHWANTH</td> 
        <td>JASHWANTH@GMAIL.COM</td>  
        <td>MOBILE</td>   
      </tr>

    </tbody>
  </table>
</div> 

</body>
<script>
  $(document).ready(function(){ 
      getAllDetails();
  })
  function getAllDetails(){ 
	  if(localStorage.getItem('login')){
		var result =  localStorage.getItem('login');  
		var res    = JSON.parse(result) ; 

        $('#getname').html(res.name);
         $.ajax({
		 type: "GET",
		 url: "http://localhost/8views/v1/get_all_users_api.php", 
		 cache: false,
		 success: function(data) {  
		  var row; 
		  var html = '';
		  $.each(data.message, function(e1){
				row = data.message[e1];  
				if(row.email != res.email){ 
				var name = row.name;
				var email = row.email;
				var role  = row.role;  
				var Rid   = row.Rid;  
				var action;   
				if(res.role == 'Viewer'){
					action = 'No Access';     
				}else if(res.role == 'Editor'){     
					action = '<button><i class="fa fa-edit" onClick="edit('+Rid+')"></i></button>';
				}else if(res.role == 'Admin'){  
					action = '<button><i class="fa fa-trash" onClick="delete('+Rid+')"></i></button>'+' '+'<button><i class="fa fa-edit" onClick="edit('+Rid+')"></i></button>'; 
				    
				}  
				html+='<tr><td>'+row.name+'</td><td>'+row.email+'</td><td>'+row.role+'</td><td>'+action+'</td></tr>'; 
				}  
			})  
			 $('#getUser').html(html);	 
		 },       
		 error: function(xhr, status, error) {  
		 var error = xhr.responseJSON;      
		 alert(error.message); 
		 }
		});		
		 
	  }else{ 
		   window.location.href = 'http://localhost/8views/views/login.php'
	  }
  }
  
  function edit(id){
	//  alert(id);  
	  $.ajax({ 
		 type: "GET",
		 url: "http://localhost/8views/v1/get_each_user.php",
         data:{
			 id: id
		 },		   
		 cache: false,
		 success: function(data) {  
			  var result = data.data
			   $('#showForm').show(); 
			   $('#name').val(result.name); 
			   $('#email').val(result.email);  
			   $('#role').val(result.role);   
			   $('#Rid').val(result.Rid);  
		 },           
		 error: function(xhr, status, error) {   
		 var error = xhr.responseJSON;       
		 alert(error.message); 
		 }
		});	
  }
  

</script>
<script>
$("#update").click(function(e) { 
	e.preventDefault();  
	alert('hii'); 
	 var name = $("#name").val();
	 var email = $("#email").val();
	 var rid = $("#Rid").val();
	 var role = $("#role").val(); 
	 if(name==''||email==''||role=='') {
	 alert("Please fill all fields.");
	 return false;
	 } 
	 
	  $.ajax({  
		 type: "POST",
		 url: "http://localhost/8views/v1/update_each_api.php", 
		 data: {
		 name: name,
		 email: email,   
		 Rid: Rid,   
		 role: role
		 },   
		 cache: false, 
		 success: function(data) {   
		 alert(data.message);  
		 getAllDetails();
		 },   
		 error: function(xhr, status, error) {
		 var error = xhr.responseJSON;   
		 alert(error.message);        
		 }
		}); 

})
</script>
</html>