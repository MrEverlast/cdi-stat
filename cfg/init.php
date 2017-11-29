<?php 

	$_DIR = $_SERVER['DOCUMENT_ROOT']; // Racine du serveur
	require_once $_DIR.'/class/BDD.php'; // Inclue la class BDD

	$json = file_get_contents($_DIR.'/cfg/config.json'); // Fichier de cfg
	$json = json_decode($json,true); // Transformation du fichier en array

	$bddName = $json['BDD'];
	$ip = $json['ip'];
	$user = $json['user'];
	$password = $json['password'];
	$port = $json['port'];
	print_r($url.$bddName.$user.$password);
	$bdd = new BDD($ip,$bddName,$user,$password,$port);

  $opatity = $json['opacity'];