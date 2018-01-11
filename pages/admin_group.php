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
	<div class="ui grid padded">
		<div class="row">
		
			<div class="five wide column">
				<table class="ui very inverted  compact table">
					
					<thead>
						<tr>
							<th>Groupes</th>
						</tr>
					</thead>
					
					<tbody >
					<?php 
						$req = $bdd->requeteBDD("SELECT DISTINCT * FROM `t_groupe` WHERE `id_division` is NULL ORDER BY `date_create` ASC");
						while ($data =$req->fetch()){
					?>
						<tr  class="data_grp" style="background: <?php echo $data['color'] . $opatity; ?>;">
							<td id="<?php echo $data['id'] ?>"><?php echo $data['name']; ?></td>
						  
						</tr>
						<?php }  ?>
					</tbody>
				</table>	
				
				<table class="ui very inverted compact table">
					<thead>
						<tr>
							<th>Demi-Groupes
							</th>
							<th>
								<select data_halfgroup="data_halfgroup" class="ui dropdown floating">
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
			
			<div class="five wide column">
					<table class="ui very inverted  compact table">
					  <thead>
						<tr>
							<th>Eleve</th>
						</tr>
					  </thead>
					  <tbody id="data_tbodygroup">
						
						
					  </tbody>
					</table>
				</div>
			
			<div class="five wide column">
					<table class="ui very inverted  compact table">
					  <thead>
						<tr>
							<th>Activité</th>
						</tr>
					  </thead>
					  <tbody id="data_tbodyacti">
						
						
					  </tbody>
					</table>
			</div>	
			
		</div>
		</div>
	</div>

	<div id="modal_main" class="ui modal">
	</div>		  
