<?php

class Login{

	public $email;

	private $conn;

	public function __construct($conn){  
		
		$this->conn = $conn; 
	    
    } 

    public function login_check()
	{
		$sql = mysqli_query($this->conn,"select * from register_app where email= '$this->email'"); 
		$data = mysqli_fetch_assoc($sql);  
		return $data;         
	}
	 

}
	
	
?>