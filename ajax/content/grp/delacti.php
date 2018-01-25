<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php';
$val=$_POST['val'];
$grp=explode(" ",$val);
$id_grp=$grp[0];
$id_activity=$grp[1];
$id_join_grp=$grp[2];

$req = $bdd->requeteBDD("SELECT C.date_prog,C.duration,B.name as name_grp,A.name as name_act FROM `t_activity` A 
                        INNER JOIN `t_groupe` B ON B.id='$id_grp'
                        INNER JOIN `t_groupe_join_activity` C ON C.id='$id_join_grp'  
                        WHERE A.id='$id_activity'"); 
				
while($data = $req->fetch()) { 

    $ts = DateTime::createFromFormat('Y-m-d H:i:s', $data['date_prog']);
	$date_prog_ordered = $ts->format('d/m/Y H:i');
?> 
  <div class="content">
    <p>Etes-vous sur de vouloir supprimer l'activité <?php echo $data['name_act'];?> du groupe <?php echo $data['name_grp']; ?> 
    qui était programmé le <?php echo $date_prog_ordered; ?> pour une durée de <?php echo $data['duration']; ?>H ?</p>
    <p>Supprimer une activité peut engendrer la perte de données.</p>
  </div>
  <input id="id_grp" value="<?php echo $id_grp; ?>" style="display:none;">
  <input id="id_activity" value="<?php echo $id_activity; ?>" style="display:none;">
</div>
<?php 
}
?>