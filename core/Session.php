<?php
class Session{
 	
 	public function __construct(){
 		// session_start();
 	}

 	public function setSession($value=[]){
		if(!isset($_SESSION['id'])){
			$_SESSION['id'] = $value;
		}
 	}

 	public function getSession($key){
		if(isset($_SESSION[$key])){
 			return $_SESSION[$key];
 		}else {
			return false;
		}
 	}

	public function deloySession($key){
		if(isset($_SESSION[$key])){
			unset($_SESSION[$key]);
		}
	}
}

?>