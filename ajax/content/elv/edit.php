<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
  <div class="field">
    <label>Elève</label>
    <select id="id_activity" class="ui search dropdown">
      <option value="">Sélectionner un élève</option>
      <?php 
        $req = $bdd->requeteBDD("SELECT * FROM `t_eleve` ORDER BY `last_name` ASC"); 
        
          while($data = $req->fetch()) { 
          ?> 
          <option value="<?php echo $data['id']; ?>"><?php echo $data['last_name']. " " . $data['first_name'] ; ?></option>
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
            <div class="ui radio checkbox">
              <input id="checkbox_grp" name="type" type="radio" checked="" tabindex="0" class="hidden">
              <label>Groupe</label>
            </div>
          </div>
          <div class="field">
            <div class="ui radio checkbox">
              <input id="checkbox_seule" name="type" type="radio" tabindex="0" class="hidden">
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