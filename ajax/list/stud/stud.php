<?php 
$classe = $_POST['val'];
$req = $bdd->requeteBDD("SELECT A.id,A.last_name,A.first_name,B.color FROM `t_eleve` A 
						INNER JOIN `t_division` B on B.id = A.id_division 
						WHERE B.nom='$classe'");
$opatity=40;
while($data=$req->fetch()){
	?>
	<tr class="data_elv_info" style="background: <?php echo $data['color']. $opatity; ?>" >
		<td id="<?php echo $data['id']; ?>" ><?php echo $data['last_name']." ".$data['first_name']; ?></td>
	</tr>
<?php } ?>
	