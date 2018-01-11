<?php 
$classe = $_POST['val'];
$req = $bdd->requeteBDD("SELECT * FROM `t_groupe` WHERE `id_division`='$classe'");
$opatity=40;
while($data=$req->fetch()){
	?>
	<tr class="data_halfgroup" style="background: <?php echo $data['color']. $opatity; ?>" >
		<td name="<?php echo $data['id'] ?>" id='<?php echo $data['id_division']; ?>' colspan=2 >
		<?php echo $data['name']; ?></td>
	</tr>
<?php } ?>
	