<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
	  <div class="field">
	    <label>Activité</label>
	    <select id="id_activity" class="ui search dropdown">
	      <option value="">Sélectionner une activité</option>
	      <?php 
	        $req = $bdd->requeteBDD("SELECT * FROM `t_activity` ORDER BY `type` DESC"); 
	        
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
	</div>
</div>