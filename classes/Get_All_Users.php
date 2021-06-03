<?php

class Get_All_Users{


	private $conn;

	public function __construct($conn){  
		
		$this->conn = $conn; 
	    
    } 

	 
	public function get_all_users(){     
		$sql = mysqli_query($this->conn,"Select * from register_app");
		//$data = mysqli_fetch_assoc($sql);      
		$result = array();           
		while($data = mysqli_fetch_assoc($sql)){  
		$result[]= array("Rid"=>$data['Rid'],"name"=>$data['name'],"email"=>$data['email'],"password"=>$data['password'],"role"=>$data['role']); 
		}   
		return $result;  
	}
}
	
	
?>