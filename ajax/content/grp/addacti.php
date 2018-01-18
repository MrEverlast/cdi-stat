<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
    <div class="field">
        <label>Activité</label>
        <select id="id_elevs" class="ui fluid search dropdown" >
            <option value="">Elèves</option>
            <?php 
                $req = $bdd->requeteBDD("SELECT * FROM `t_activity` WHERE `type` = 1"); 
                
                    while($data = $req->fetch()) { 
                    ?> 
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                    <?php
                    }
                ?>
        </select>
    </div>
    <div class ="field">
    <div id="calendarMain" class="calendarMain"></div>
    <div id="calendarText"></div>
    
    <div>  

        <input id="id_activity" value="<?php echo $groupe; ?>" style="display:none;">


	</div>
</div>