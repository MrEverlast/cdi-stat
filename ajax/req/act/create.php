<?php 

	$name = $_POST['name'];
	$color = $_POST['color'];
	$type = $_POST['type'];
	$date = date("Y-m-d h:i:s"); //2017-11-27 12:10:42
	$query = "
		INSERT INTO `t_activity` (`name`, `date_create`,`color`, `type`) 
		VALUES ('$name', '$date','$color', $type)
	";

	$bdd->requeteBDD($query);

 ?>