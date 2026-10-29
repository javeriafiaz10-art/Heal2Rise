<?php 

	session_start();
	ob_start();

	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db_name = 'heal_rise';

	$db = new mysqli($host, $user, $pass, $db_name);

	if($db->connect_error):
		echo $db->connect_error;
	endif;

	if(isset($_SESSION['id']) && isset($_SESSION['role'])){

		$user_id 	= $_SESSION['id'];
		$user_role 	= $_SESSION['role'];
		
	}

 ?>
