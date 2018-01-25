<?php 
    

    $id_grp = $_POST['id_grp'];
    $date_prog = $_POST['date_prog'];
    $id_activity = $_POST['idActivity'];
    $duration = $_POST['duree'];

	$ts = DateTime::createFromFormat('d-m-Y H:i', $date_prog);
	$date_prog_ordered = $ts->format('Y-m-d H:i:s');
	
	
	$query ="INSERT INTO `t_groupe_join_activity`(`id_activity`, `id_groupe`, `date_prog`, `duration`)
            VALUES ('$id_activity','$id_grp','$date_prog_ordered','$duration')";
    $bdd->requeteBDD($query); 
    echo $id_activity."  ".$id_grp."  ".$date_prog_ordered."  ".$duration;
 ?>