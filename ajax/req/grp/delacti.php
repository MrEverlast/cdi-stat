<?php 

        $id_grp = $_POST['id_grp'];
        $id_activity = $_POST['idActivity'];




		$query = "DELETE FROM `t_groupe_join_activity` 
                WHERE `t_groupe_join_activity`.`id_groupe`=$id_grp 
                AND  `t_groupe_join_activity`.`id_activity`=$id_activity";
		$bdd->requeteBDD($query);



 ?> 