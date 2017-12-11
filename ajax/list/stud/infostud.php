<?php 
$nomprenom = $_POST['val'];

$identite = explode(" ",$nomprenom);



$req = $bdd->requeteBDD("SELECT A.id,A.last_name,A.first_name,A.date_born,A.city,A.post_code,B.nom,B.color 
						FROM `t_eleve` A INNER JOIN `t_division` B on B.id = A.id_division 
						WHERE A.last_name='$identite[0]'");
$opatity=40;
while($data=$req->fetch()){
	?>
	<tr class="data_elv_info" style="background: <?php echo $data['color']. $opatity; ?>" >
		<th >NOM</th>
		<td ><?php echo $data['last_name']; ?></td>
	</tr>
	
	<tr style="background: <?php echo $data['color']. $opatity; ?>" >
		<th >PRENOM</th>
		<td ><?php echo $data['first_name']; ?></td>
	</tr>
	
	<tr style="background: <?php echo $data['color']. $opatity; ?>" >
		<th >CLASSE</th>
		<td ><?php echo $data['nom']; ?></td>
	</tr>
	
	<tr style="background: <?php echo $data['color']. $opatity; ?>" >
		<th >DATE NAISSANCE</th>
		<td ><?php echo $data['date_born']; ?></td>
	</tr>
	
	<tr style="background: <?php echo $data['color']. $opatity; ?>" >
		<th >VILLE</th>
		<td ><?php echo $data['city']; ?></td>
	</tr>
	
	<tr style="background: <?php echo $data['color']. $opatity; ?>" >
		<th>CODE POSTAL</th>
		<td ><?php echo  $data['post_code']; ?></td>
	</tr>
	
	<tr style="background: <?php echo $data['color']. $opatity; ?>" >
		<th class="center aligned" colspan="2">GROUPE</th>
		
	</tr>
	<?php 
		$id_eleve=$data['id'];
		$req2 = $bdd->requeteBDD("SELECT * FROM `t_eleve_join_groupe` A 
								  INNER JOIN `t_groupe` B ON B.id=A.id_groupe 
								  WHERE id_eleve='$id_eleve'");
		while($data2=$req2->fetch()){
	?>
		<tr style="background: <?php echo $data2['color']. $opatity; ?>" >
			<td class="center aligned" colspan="2"><?php echo $data2['name'] ?></td>
		</tr>
	<?php }  ?>
	
	<tr style="background: <?php echo $data['color']. $opatity; ?>" >
		<th class="center aligned" colspan="2">ACTIVITE</th>
		
	</tr>
	<?php 
	
	//SELECT * FROM  `t_activity` AINNER JOIN  `t_groupe_join_activity` BINNER JOIN  `t_eleve_join_groupe` CINNER JOIN  `t_activity` D ON B.id = A.id_groupeAND A.id_activity = D.idWHERE id_eleve =  '4'
		$id_eleve=$data['id'];
		$req3 = $bdd->requeteBDD("SELECT * FROM `t_groupe_join_activite` A 
								  INNER JOIN `t_groupe` B ON B.id=A.id_groupe 
								  WHERE id_eleve='$id_eleve'");
		while($data3=$req3->fetch()){
	?>
		<tr style="background: <?php echo $data3['color']. $opatity; ?>" >
			<td class="center aligned" colspan="2"><?php echo $data3['name'] ?></td>
		</tr>
	<?php }  ?>
<?php } ?>
	