<?php 
$id_activity = $_POST['val'];
$opatity=40;
date_default_timezone_set("Europe/Paris");
$str_date=date("Y-m-d H:i:s");
$req = $bdd->requeteBDD("SELECT A.date_prog,B.name,B.color FROM `t_groupe_join_activity` A
                        INNER JOIN `t_groupe` B ON B.id=A.id_groupe
                        WHERE `id_activity`='$id_activity'
                        AND A.date_prog > '$str_date'
                        ORDER BY A.date_prog ASC");

while($data=$req->fetch()){
    $ts = DateTime::createFromFormat('Y-m-d H:i:s', $data['date_prog']);

	$date_prog_ordered = $ts->format('d/m/Y à H:i');
?>
        <tr class="data_tbodygroup" style="background: <?php echo $data['color']. $opatity; ?>" >
            <td >
            <?php echo $data['name']." le ".$date_prog_ordered; ?>
            </td>
        </tr>
<?php 
    }	?>
