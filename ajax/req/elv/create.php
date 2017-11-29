<?php 

	$name = $_POST['name'];
	$color = $_POST['color'];
	$type = $_POST['type'];

	$query = "INSERT INTO `t_activity` (`name`,`color`, `type`) VALUES ('$name', '$color', $type)";

	$bdd->requeteBDD($query);

 ?>