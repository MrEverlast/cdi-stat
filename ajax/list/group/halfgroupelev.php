<?php 
$classe = $_POST['val'];
$choix = $_POST['choix'];
$opatity=40;

$req = $bdd->requeteBDD("SELECT A.id,A.last_name,A.first_name,B.color 
						FROM `t_eleve` A INNER JOIN `t_division` B ON B.id=`id_division` 
						WHERE `id_division`='$classe'");
						
$statement = $bdd->requeteBDD("SELECT COUNT(*) compt FROM `t_eleve` WHERE `id_division`='$classe' GROUP BY `id_division`");
$dataCount = $statement->fetch();
$statement->closeCursor();
$i=1;
$limit=($dataCount['compt'])/2;
if($limit < 1){
	$limit=0;
}
if($choix == "A"){
	while($data=$req->fetch()){
		if($i<=$limit)	{
?>
			<tr class="data_tbodyhalfgroup" style="background: <?php echo $data['color']. $opatity; ?>" >
				<td ><?php echo $data['last_name']." ".$data['first_name']; ?></td>
			</tr>
<?php 
		$i++; 
		}
	}	
} if($choix == "B"){
			
			while($data=$req->fetch()){
				if($i>$limit)	{
?>
				<tr class="data_tbodyhalfgroup" style="background: <?php echo $data['color']. $opatity; ?>" >
					<td ><?php echo $data['last_name']." ".$data['first_name']; ?></td>
				</tr>
<?php	
				}
				$i++;
			}
			
}
?>

	