<?php 
    $id_elevs = $_POST['id_elevs'];
	$id_grp = $_POST['id_grp'];
	date_default_timezone_set("Europe/Paris");
    $today = date("Y-m-d H:i:s"); 

    $lengthof_id_elevs = sizeof($id_elevs);
	$i=0;
	$value="";
	while($i<$lengthof_id_elevs){
		$id_eleve_tempo=$id_elevs[$i];
		$value.="('$id_grp','$id_eleve_tempo','$today')";
		$i++;
		if($i<$lengthof_id_elevs) $value.=",";
	}
	
	
	$query ="INSERT INTO `t_eleve_join_groupe`(`id_groupe`, `id_eleve`, `date_create`) 
			 VALUES ".$value;
    $bdd->requeteBDD($query); 
    echo $id_grp;
 ?>