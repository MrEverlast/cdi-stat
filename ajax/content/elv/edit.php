<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
	  <div class="field">
		<label>Elève</label>
		<select id="id_elev" data-selected="selected_elev" class="ui search dropdown">
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
		    
				<div class="ui input">
					<input id="classe" readonly="" type="text">

						<div class="ui floating dropdown icon button">
						<i class="dropdown icon"></i>
						<div  class="menu class_name" class-selected="selected-class">
						<?php 
						$req = $bdd->requeteBDD("SELECT * FROM `t_division`  
												ORDER BY `t_division`.`ordre` ASC, `t_division`.`nom` ASC"); 
						
							while($data = $req->fetch()) { 
							
							?>
							<div class="item class_deroulante"><?php echo $data['nom']; ?></div>
							<?php
							}
							?> 
						</div>
				  </div>
				</div>
			
		 </div>
		 <div class="field">
		 <label>Demi-groupe</label>
					<div class="ui input">
					<input id="demi_grp" readonly="" type="text">

				  <div class="ui floating dropdown icon button">
						<i class="dropdown icon"></i>
							<div class="menu demigrp_name" demigrp-selected="selected-demi_grp">
								<div class="item demigrp_deroulante">Groupe 1</div>
								<div class="item demigrp_deroulante">Groupe 2</div>
							</div>
						</div>
					</div>
		 </div>
		</div>
	  <div class="two fields">
		 <div class="field">
		    <label>Date de naissance</label>
		    <input id="date_born" placeholder="JJ/MM/AAAA" type="text" autocomplete="none">
		 </div>
	  </div>
	  <div class="two fields">
		  <div class="field">
		    <label>Ville</label>
			<input id="city" type="text" autocomplete="none">
		  </div>
		  <div class="field">
		    <label>Code Postal</label>
			<input id="post_code" type="text" autocomplete="none">
		  </div>
	  </div>
    
	</div>
</div>