<div class="ui basic segment">
	<h2 class="ui dividing header">
    Gestion de groupe
  </h2>
		<div class="ui buttons">
		  <button id="grp_create" class="ui green button myTrigger"><i class="icon add"></i>Créer</button>
		  <button id="grp_edit" class="ui blue button myTrigger"><i class="edit icon"></i>Modifier</button>
		  <button id="grp_delete" class="ui red button myTrigger"><i class="remove icon"></i>Supprimer</button>
		</div>
	<div class="ui container fluid">
		<div class="ui three column doubling stackable grid container">	
			<div class="column">
				<table class="ui very compact table">
					<thead>
						<tr>
							<th>Groupes</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$req = $bdd->requeteBDD("SELECT DISTINCT * FROM `t_groupe` ORDER BY `date_create` ASC");
						while ($data =$req->fetch()){
					?>
						<tr  class="data_grp" style="background: <?php echo $data['color'] . $opatity; ?>;">
							<td ><?php echo $data['name']; ?></td>
						  
						</tr>
						<?php }  ?>
					</tbody>
				</table>	
				<table class="ui very compact table">
					<thead>
						<tr>
							<th>Demi-Groupes
							</th>
							<th>
								<select data_halfgroup="data_halfgroup" class="ui search dropdown">
								 <option value="">Choisir une classe</option>
								<?php 
									$reqClass = $bdd->requeteBDD("SELECT DISTINCT * FROM `t_division` ORDER BY `ordre` ASC");
									while ($dataClass =$reqClass->fetch()){
								?>
									  <option value="<?php echo $dataClass['id'] ?>"><?php echo $dataClass['nom'] ?></option>
								<?php }  ?>
								</select>
								
							</th>
						</tr>
					</thead>
					<tbody id="data_halfgrp">
					</tbody>
				</table>	
			</div>		
			
			<div class="column">
					<table class="ui very compact table">
					  <thead>
						<tr>
							<th>Eleve</th>
						</tr>
					  </thead>
					  <tbody id="data_tbodyhalfgroup">
						
						
					  </tbody>
					</table>
				</div>
			
			<div class="column">
			
			</div>	
			
		</div>
	</div>
	<div id="modal_main" class="ui modal">
			  
	</div>
	
</div>