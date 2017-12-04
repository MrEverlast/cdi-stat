<?php 
	$idElev = $_POST['id_elev'];


	$query = "DELETE FROM `t_eleve` WHERE `t_eleve`.`id`=$idElev";

	$bdd->requeteBDD($query);

	echo $idElev;
 ?>