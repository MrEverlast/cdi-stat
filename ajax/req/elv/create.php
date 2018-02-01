<?php 
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$post_code = $_POST['post_code'];
	$city = $_POST['city'];
	$id_classe = $_POST['id_classe'];
	$query = "SELECT * FROM `t_groupe` WHERE `id_division`='$id_classe'";
	$sth = $bdd->requeteBDD($query);
	while($data = $sth->fetch()){
	$demi_groupe = $data['id'];
	}
	$query = "INSERT INTO `t_eleve` (`last_name`,`first_name`,`city`,`post_code`,`id_division`,`id_demigroupe`) 
			  VALUES ('$last_name', '$first_name', '$city' , '$post_code' ,'$id_classe','$demi_groupe')";

	$bdd->requeteBDD($query);

 ?>