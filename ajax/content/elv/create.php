<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
		<div class="two fields">
		  <div class="required field">
		    <label>Nom</label>
		    <input id="last_name" type="text" autocomplete="none" onkeyup='this.value=this.value.toUpperCase()'>
		  </div>
		  <div class="required field">
			<label>Prénom</label>
		    <input id="first_name" type="text" autocomplete="none">
		  </div>
		</div>
		<div class="two fields">
		  <div class="field">
		    <label>Ville</label>
		    <input id="city" type="text" autocomplete="none" >
		  </div>
		  <div class="field">
			<label>Code Postal</label>
		    <input id="post_code" type="text" autocomplete="none">
		  </div>
		</div>
		<div class="two fields">
		  <div class="required field">
		  	<label>Classe</label>
			<select id="id_classe" class="ui search dropdown">
			<option value="">Sélectionner une activité</option>
			<?php 
	        $req = $bdd->requeteBDD("SELECT * FROM `t_division` ORDER BY `ordre` ASC"); 
	        
	          while($data = $req->fetch()) { 
	            
	          ?> 
	          <option value=" <?php echo $data['id']; ?> " > <?php echo $data['nom']; ?> </option>
	          <?php
	          }
	       ?>
			</select>
		  </div>
		</div>
		
	</div>
</div>
