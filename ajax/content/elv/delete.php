<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
  <div class="content">
	<div class="ui form">
		<div class="two fields">
		  <div class="field">
		  	<label>Elève</label>
			<select id="id_elev" class="ui search dropdown">
			<option value="">Sélectionner un élève</option>
			<?php 
	        $req = $bdd->requeteBDD("SELECT A.id,`first_name`,`last_name`,`nom` FROM `t_eleve` A INNER JOIN `t_division` B on B.id = A.id_division ");
	        
	          while($data = $req->fetch()) { 
	            
	          ?> 
	          <option value=" <?php echo $data['id']; ?> " > <?php echo $data['first_name']." ".$data['last_name']." ".$data['nom']; ?> </option>
	          <?php
	          }
	       ?>
			</select>
		  </div>
		</div>
	</div>
</div>