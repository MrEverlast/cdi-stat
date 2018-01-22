<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
    <div class="field">
        <label>Activité</label>
        <select id="id_elevs" class="ui fluid search dropdown" >
            <option value="">Activité</option>
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
    <div class ="two field">
        <div class="field">            
            <div class="ui calendar" id="example1">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="jj-mm-AAAA hh:mm" readonly="true">
                </div>
            </div>
        </div>
    
        <div class="field">
                    <label>Durée</label>
                    <select class="ui search dropdown" id="duree">
						<option value="">Selectionnez la durée..</option>
						<!--          // BASE //           -->
						<option value="1">1h</option>
						<option value="2">2h</option>
						<option value="3">3h</option>
						<option value="4">4h</option>
						<!--        /////////////////     -->
					</select>
        </div>
    </div>
    <div>  

        <input id="id_activity" value="<?php echo $groupe; ?>" style="display:none;">


	</div>
</div>