<?php 
$choix = $_POST['choix'];
$opatity=40;

$req = $bdd->requeteBDD("SELECT * FROM `t_groupe_join_activity` 
                        INNER JOIN `t_activity` B ON `id_activity`=B.id WHERE `id_groupe`='$choix' ");
						
	while($data=$req->fetch()){
?>
			<tr class="data_tbodyhalfgroup" style="background: <?php echo $data['color']. $opatity; ?>" >
				<td >
                        <i class="red remove icon"></i>
                        <?php echo $data['name']; ?>
                            
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