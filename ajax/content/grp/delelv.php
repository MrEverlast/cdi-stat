<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php';
$val=$_POST['val'];
$grp=explode(" ",$val);
$id_grp=$grp[0];
$id_elv=$grp[1];
$req = $bdd->requeteBDD("SELECT A.last_name,A.first_name,B.name FROM `t_eleve` A 
                        INNER JOIN `t_groupe` B ON B.id='$id_grp' WHERE A.id='$id_elv'"); 
				
while($data = $req->fetch()) { 
?> 
  <div class="content">
    <p>Etes-vous sur de vouloir supprimer <?php echo $data['last_name']." ".$data['first_name'];?> du groupe <?php echo $data['name']; ?>  ?</p>
    <p>Supprimer un élève peut engendrer la perte de données.</p>
  </div>
  <input id="id_grp" value="<?php echo $id_grp; ?>" style="display:none;">
  <input id="id_elev" value="<?php echo $id_elv; ?>" style="display:none;">
</div>
<?php 
}
?>