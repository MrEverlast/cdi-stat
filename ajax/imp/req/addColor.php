<?php 
	session_start();
	$color = json_decode($_POST['color']);
	for ($i=0; $i < count($color) ; $i++) { 
		$_SESSION['class_color'] = $color[$i];
	}