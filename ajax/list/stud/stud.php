<?php 
$classe = $_POST['val'];
$req = $bdd->requeteBDD("SELECT * FROM `t_eleve` A INNER JOIN `t_division` B on B.id = A.id_division WHERE B.nom='$classe'");
$opatity=40;
while($data=$req->fetch()){
	?>
	<tr style="background: <?php echo $data['color']. $opatity; ?>" >
		<td ><?php echo $data['last_name']." ".$data['first_name']; ?></td>
	</tr>
<?php } ?>
	