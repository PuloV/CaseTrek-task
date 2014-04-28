<?php

class Admin
{

	function __construct($user,$pass)
	{
		$this->user = $user;
		$this->pass = $pass;
	}

	function login(){
		if($this->user = "admin" && $this->pass = "pass"){
			$this->id = 1;
			return true;
		}
		else return false;
	}
	static function print_login(){
		$form = '<form action="admin.php?log=in" method="POST">
				<input name= "username" type="text" placeholder="Username">
				<input name= "password" type="password" placeholder="Password">
				<input name= "submit" type="submit" value="Login"></form>';
		echo $form;
	}

}


if(array_key_exists("log", $_GET)){
	$log_task = $_GET["log"];
	if($log_task == "out"){
		$_SESSION['logged'] = false;
		$_SESSION['admin'] = 0;
	}
	if($log_task == "in"){
		if(array_key_exists("username", $_POST)){
			$admin = new Admin($_POST["username"],$_POST["password"]);
			if($admin->login())
			{
				$_SESSION['logged'] = true;
				$_SESSION['admin'] = $admin->id;
				header('Location: admin.php');
			}
		}
	}

}