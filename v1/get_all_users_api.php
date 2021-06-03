<?php

ini_set('display_errors',1); 
//include header 
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=utf-8");  

//includes
include('../config/db.php');
include('../classes/Get_All_Users.php');  

//get connection 
$dbcon = new DabaseConnection();  
$conn = $dbcon->connect();   
 
//passing connection
$Get_All_Users = new Get_All_Users($conn);  

if($_SERVER['REQUEST_METHOD'] == 'GET'){   
 
    $result = $Get_All_Users->get_all_users();
	 
	if(!empty($result)){  
		   
	 http_response_code(200);  
	 echo json_encode(array("status"=>0,"message"=>$result));   
	}    
	else{ 
		
		http_response_code(400);  
	echo json_encode(array("status"=>0,"message"=>"No Records found")); 
	}
}else{
    http_response_code(505); 
	echo json_encode(array("status"=>0,"message"=>"Access Denied")); 
}    
 

?>