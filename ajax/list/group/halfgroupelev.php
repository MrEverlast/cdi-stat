<?php 
$classe = $_POST['val'];
$choix = $_POST['choix'];
$opatity=40;

$req = $bdd->requeteBDD("SELECT A.id,A.last_name,A.first_name,B.color 
						FROM `t_eleve` A INNER JOIN `t_division` B ON B.id=`id_division` 
						WHERE `id_division`='$classe' AND `id_demigroupe`='$choix' ");
						
	while($data=$req->fetch()){
?>
			<tr class="data_tbodyhalfgroup" style="background: <?php echo $data['color']. $opatity; ?>" >
				<td ><?php echo $data['last_name']." ".$data['first_name']; ?></td>
			</tr>
<?php 
		
	}	
?>
			<tr>							
				<td class="collapsing">
				<i class="plus icon"></i> Ajouter un élève
				</td>
			</tr>
			