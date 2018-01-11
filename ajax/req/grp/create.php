<?php 
	$groupe = $_POST['groupe'];
	$id_elevs = $_POST['id_elevs'];

	$today = date("Y-m-d H:i:s"); 

	$query = "INSERT INTO `t_groupe` (`name`,`date_create`) 
			  VALUES ('$groupe','$today')";
	$bdd->requeteBDD($query);

	$query1 = "SELECT MAX(id) FROM `t_groupe` WHERE 1";
	$result=$bdd->requeteBDD($query1);
	while($data = $result->fetch()){
	$id_groupe=$data['MAX(id)'];
	}

	$lengthof_id_elevs = sizeof($id_elevs);
	$i=0;
	$value="";
	while($i<$lengthof_id_elevs){
		$id_eleve_tempo=$id_elevs[$i];
		$value.="('$id_groupe','$id_eleve_tempo','$today')";
		$i++;
		if($i<$lengthof_id_elevs) $value.=",";
	}
	
	
	$query2 ="INSERT INTO `t_eleve_join_groupe`(`id_groupe`, `id_eleve`, `date_create`) 
			 VALUES ".$value;
	$bdd->requeteBDD($query2); 
 ?>