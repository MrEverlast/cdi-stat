<?php 
$classe = $_POST['val'];
$req = $bdd->requeteBDD("SELECT * FROM `t_division` WHERE `id`='$classe'");
$opatity=40;
while($data=$req->fetch()){
	?>
	<tr class="data_halfgroup" style="background: <?php echo $data['color']. $opatity; ?>" >
		<td name="A" id='<?php echo $data['id']; ?>' colspan=2 >Groupe A</td>
	</tr>
	<tr  class="data_halfgroup" style="background: <?php echo $data['color']. $opatity; ?>" >

		<td name="B" id='<?php echo $data['id']; ?>' colspan=2 >Groupe B</td>
	</tr>
<?php } ?>
	