<?php

ini_set('display_errors',1); 
//include header 
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");     

//includes
include('../config/db.php');
include('../classes/Register.php'); 
 
//get connection
$dbcon = new DabaseConnection(); 
$conn = $dbcon->connect();  
 
//passing connection
$Register = new Register($conn);     

if($_SERVER['REQUEST_METHOD'] == 'POST'){   
	
//	$data =   json_decode(file_get_contents("php://input"));
	 $name = $_POST['name']; 
	 $email = $_POST['email']; 
	 $Rid = $_POST['Rid'];   
	 $role = $_POST['role'];   
	if(!empty($name) && !empty($email) && !empty($Rid) && !empty($role)){
		
		$Register->name = $name;
		$Register->email = $email;    
		$Register->rid = $Rid;   
		$Register->role = $role; 
		      
			if($Register->update_each_reg()){   
				http_response_code(200);   
				echo json_encode(array("status"=>1,"message"=>'updated Successfully Successfully'));
			}else{
				http_response_code(500); 
				echo json_encode(array("status"=>0,"message"=>'Something went wrong')); 
			} 
	
		
	}else{
		http_response_code(404);
		echo json_encode(array("status"=>0,"message"=>'All fields are required'));
	}
	 
}else{ 
	
	http_response_code(505);
	echo json_encode(array("status"=>0,"message"=>"Access Denied")); 
	
}

?>