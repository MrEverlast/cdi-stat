<?php 
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$post_code = $_POST['post_code'];
	$city = $_POST['city'];
	$id_classe = $_POST['id_classe'];

	$query = "INSERT INTO `t_eleve` (`last_name`,`first_name`,`city`,`post_code`,`id_division`) 
			  VALUES ('$last_name', '$first_name', '$city' , '$post_code' ,'$id_classe')";

	$bdd->requeteBDD($query);

 ?>