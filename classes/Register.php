<?php

class Register{
	
	public $name;
	public $email;
	public $password;
	public $role; 
	public $rid; 
	private $conn;
	private $table_name; 
	public function __construct($conn){
		
		$this->conn = $conn;
		$this->table_name = 'register_app';
		
	} 
	  
	public function check_email($email){ 
		
		$sql = mysqli_query($this->conn,"select * from ".$this->table_name . " where email = '$email' ");
		
		$data = mysqli_fetch_assoc($sql); 
	   // print_r($data);     
	   return $data;       
		  
	}
	       
	public function insert_reg(){     
		$sql = mysqli_query($this->conn,"insert into ".$this->table_name."  (Rid,name,email,password,role) values  ('','$this->name','$this->email','$this->password','$this->role')"); 
	       
		if($sql){  
			return true;
		}else{            
			return false;     
		}
		
	}
	
	public function update_each_reg(){
		$sql = mysqli_query($this->conn,"UPDATE ".$this->table_name." SET name='$this->name',email='$this->email',role='$this->role'  WHERE Rid='$this->rid'");
		if($sql){  
			return true;
		}else{            
			return false;        
		}
	}
	    
	
	public function get_each_user($id){  
		$sql = mysqli_query($this->conn,"Select * from ".$this->table_name. " where Rid = '$id' ");
		$result = mysqli_fetch_assoc($sql);    
		 
		return $result;   
	}
}


?>