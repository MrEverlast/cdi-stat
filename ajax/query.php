<?php 

if (isset($_POST['targetDir'])) {
	$targetDir = $_POST['targetDir'];

	$_DIR = $_SERVER['DOCUMENT_ROOT']; // Racine du serveur
	include_once $_DIR.'/cfg/init.php'; // Connect bdd
	// Type string => 'req_act_create'
	$arrayDir = explode('_', $targetDir);

	include_once $_DIR.'/ajax/'.$arrayDir[0].'/'.$arrayDir[1].'/'.$arrayDir[2].'.php';
} else {
	echo "targetDir Error";
}