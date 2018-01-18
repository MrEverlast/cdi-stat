<?php 

        $id_grp = $_POST['id_grp'];
        $id_elev = $_POST['id_elev'];




		$query = "DELETE FROM `t_eleve_join_groupe` 
                WHERE `t_eleve_join_groupe`.`id_eleve`=$id_elev 
                AND  `t_eleve_join_groupe`.`id_groupe`=$id_grp";
		$bdd->requeteBDD($query);



 ?> 