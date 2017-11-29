<?php 

	$name = $_POST['name'];
	$color = $_POST['color'];
	$type = $_POST['type'];
	$idActivity = $_POST['idActivity'];

	$query = "UPDATE `t_activity` SET `name` = '$name', `color` = '$color', `type` = $type WHERE `id` = $idActivity";

	$bdd->requeteBDD($query);