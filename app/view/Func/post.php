<?php


function cha($user) {
	$user;
}

class ser{
	public $func = "func";
	public $user = "user";
    
	function __destruct(){
		$par = $this->func;		
		$par($this->user);
	}
}


$obj = unserialize("O:3:\"ser\":2:".$data);

$json = json_encode($obj);

echo $json;


?>