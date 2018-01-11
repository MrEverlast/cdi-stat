<?php 

		if(isset($_POST['id_group'])){
			$id_grp = $_POST['id_group'];

			$query = "SELECT * FROM `t_groupe`
			WHERE `id`='$id_grp'";

			$sth = $bdd->requeteBDD($query);
				while($result = $sth->fetch()){
					$nom_grp=$result['name'];
				}
			echo $nom_grp;
		}

		if(isset($_POST['id_grp'])){
			$id_grp = $_POST['id_grp'];
			$groupe = $_POST['groupe'];

			$query = "UPDATE `t_groupe` SET `name`='$groupe' WHERE `id`='$id_grp'";
			$bdd->requeteBDD($query);
		
		}
 ?>