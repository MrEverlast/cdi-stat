<?php 
$activite = $_POST['val'];
$opatity=40;

$req = $bdd->requeteBDD("SELECT A.id,A.last_name,A.first_name,C.color FROM `t_eleve` A 
                        INNER JOIN `t_eleve_join_groupe` B 
                        ON B.id_groupe='$activite' 
                        AND B.id_eleve=A.id
                        INNER JOIN `t_division` C
                        ON A.id_division=C.id
                        WHERE 1");

while($data=$req->fetch()){
?>
        <tr class="data_tbodygroup" style="background: <?php echo $data['color']. $opatity; ?>" >
            <td ><?php echo $data['last_name']." ".$data['first_name']; ?></td>
        </tr>
<?php 
    }	?>