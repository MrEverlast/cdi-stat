<?php 
$choix = $_POST['choix'];
$opatity=40;

$req = $bdd->requeteBDD("SELECT A.id,A.id_activity,A.date_prog,B.name,B.color FROM `t_groupe_join_activity` A
                        INNER JOIN `t_activity` B ON `id_activity`=B.id WHERE `id_groupe`='$choix' ORDER BY A.date_prog ASC");
						
	while($data=$req->fetch()){

	$ts = DateTime::createFromFormat('Y-m-d H:i:s', $data['date_prog']);
	$date_prog_ordered = $ts->format('d/m/Y à H:i');
?>
	
		<tr class="data_tbodyhalfgroup" style="background: <?php echo $data['color']. $opatity; ?>" >
			<td >
                <i id="grp_delacti_<?php echo $choix." ".$data['id_activity']." ".$data['id']; ?>" class="red remove icon myTrigger"></i>
                <?php echo $data['name']." le ".$date_prog_ordered; ?>
                            
            </td>
			
               
		</tr>
<?php 
		
	}	
?>
			<tr>							
				<td id="grp_addacti_<?php echo $choix; ?>" class="collapsing myTrigger">
				<i class="plus icon"></i> Programmer une activité
				</td>
			</tr>