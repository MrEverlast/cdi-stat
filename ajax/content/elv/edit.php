<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
	  <div class="field">
		<label>Elève</label>
		<select id="select_elev" data-selected="selected_elev" class="ui search dropdown">
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
		 <label>Classe</label>
		    <div class="ui teal">
				<div class="ui action input">
				  <div class="ui floating dropdown icon button">
				  <i class="dropdown icon"></i>
					<div class="menu">
					<?php 
					$req = $bdd->requeteBDD("SELECT * FROM `t_division`  
											 ORDER BY `t_division`.`ordre` ASC, `t_division`.`nom` ASC"); 
					
					  while($data = $req->fetch()) { 
					  ?>
						<div class="item"><?php echo $data['nom']; ?></div>
					  <?php
					  }
					  ?> 
					</div>
				  </div>
				</div>
			</div>
		 </div>
		</div>
	  <div class="two fields">
		 <div class="field">
		    <label>Date de naissance</label>
		    <input id="date_born" type="text" autocomplete="none">
		 </div>
	  </div>
	  <div class="two fields">
		  <div class="field">
		    <label>Ville</label>
			<input id="city" type="text" autocomplete="none">
		  </div>
		  <div class="field">
		    <label>Code Postal</label>
			<input id="postal_code" type="text" autocomplete="none">
		  </div>
	  </div>
    
	</div>
</div>