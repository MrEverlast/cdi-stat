<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
  <div class="field">
    <label>Activité</label>
    <select id="id_activity" data_acti="req_act_edit" class="ui search dropdown">
      <option value="">Sélectionner une activité</option>
      <?php 
        $req = $bdd->requeteBDD("SELECT * FROM `t_activity` ORDER BY `type` DESC, `date_create` DESC"); 
        
          while($data = $req->fetch()) { 
            if($data['type'])
              $typeAct = "Groupe";
            else 
              $typeAct = "Seule";
          ?> 
          <option value="<?php echo $data['id']; ?>"><?php echo $data['name']. " - " . $typeAct; ?></option>
          <?php
          }
       ?>
    </select>
  </div>
		<div class="two fields">
      <div class="field">
        <label>Nom de l'activité</label>
        <input id="name" type="text" autocomplete="none">
      </div>
      <div class="field">
        <div class="grouped fields">
          <label for="fruit">Type d'activité:</label>
          <div class="field">
            <div id="checkbox_groupe" class="ui radio checkbox">

              <input id="checkbox_grp" name="type" type="radio" checked="" tabindex="0" class="hidden">

              <label>Groupe</label>
            </div>
          </div>
          <div class="field">
            <div id="checkbox_seule" class="ui radio checkbox">
              <input id="checkbox_seul" name="type" type="radio" checked="" tabindex="0" class="hidden">
              <label>Seule</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="field">
      <label>Couleur de l'activité</label>
      <button id="color" class="ui button" style="height: 5rem;width: 5rem;"></button>
    </div>
	</div>
</div>