<?php 

	$_DIR = $_SERVER['DOCUMENT_ROOT']; // Racine du serveur
	require_once $_DIR.'/class/BDD.php'; // Inclue la class BDD

	$json = file_get_contents($_DIR.'/cfg/config.json'); // Fichier de cfg
	$json = json_decode($json,true); // Transformation du fichier en array

	$bddName = $json['BDD'];
	$url = $json['url'];
	$user = $json['user'];
	$password = $json['password'];
	$bdd = new BDD($url,$bddName,$user,$password);

  $opatity = $json['opacity'];