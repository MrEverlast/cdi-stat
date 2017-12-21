<?php 
	session_start();
	$_DIR = $_SERVER['DOCUMENT_ROOT'];
	$bddName = $_POST['bddname'];

	$json = file_get_contents($_DIR.'/cfg/config.json'); // Fichier de cfg
	$json = json_decode($json,true); // Transformation du fichier en array

	$bddName = $json['BDD'];
	$ip = $json['ip'];
	$user = $json['user'];
	$password = $json['password'];
	$port = $json['port'];

	if (
		isset($_SESSION['class']) &&
		isset($_SESSION['class_selected']) &&
		isset($_SESSION['class_niveau']) &&
		isset($_SESSION['class_color'])
	) {
		
		$bdd = new PDO("mysql:host=".$ip, $user, $password);

		
	}
 ?>