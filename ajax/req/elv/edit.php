<?php 
	$id_eleve = $_POST['id_eleve'];


	$query = "SELECT * FROM `t_eleve` WHERE `id`='$id_eleve'";

	$sth = $bdd->requeteBDD($query);
	while($result = $sth->fetch()){
		echo $result['last_name']."_".$result['first_name']."_".$result['city']."_".$result['post_code']."_".$result['id_division'];
	}
 ?>