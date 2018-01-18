<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
    <div class="field">
        <label>Ajouter des élèves</label>
        <select id="id_elevs" class="ui fluid search dropdown" multiple="">
            <option value="">Elèves</option>
            <?php 
                $req = $bdd->requeteBDD("SELECT * FROM `t_eleve` A
                                        WHERE A.id NOT IN 
                                            (SELECT B.id_eleve FROM `t_eleve_join_groupe` B 
                                            WHERE B.id_groupe='$groupe') 
                                        ORDER BY `last_name` ASC"); 
                
                    while($data = $req->fetch()) { 
                    ?> 
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['last_name']. " " . $data['first_name'] ; ?></option>
                    <?php
                    }
                ?>
        </select>
    </div>


        <input id="id_grp" value="<?php echo $groupe; ?>" style="display:none;">


	</div>
</div>