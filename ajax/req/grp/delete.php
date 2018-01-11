<?php 

		$id_grp = $_POST['id_grp'];


		$query = "DELETE FROM `t_groupe_join_activity` WHERE `t_groupe_join_activity`.`id_groupe`=$id_grp";
		$bdd->requeteBDD($query);

		$query = "DELETE FROM `t_eleve_join_groupe` WHERE `t_eleve_join_groupe`.`id_groupe`=$id_grp";
		$bdd->requeteBDD($query);

		$query = "DELETE FROM `t_groupe` WHERE `t_groupe`.`id`=$id_grp";
		$bdd->requeteBDD($query);
	

 ?>