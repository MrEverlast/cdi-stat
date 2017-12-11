<div class="ui basic segment">
		<div class="ui buttons">
		  <button id="elv_create" class="ui green button myTrigger"><i class="icon add"></i>Créer</button>
		  <button id="elv_edit" class="ui blue button myTrigger"><i class="icon edit"></i>Modifier</button>
		  <button id="elv_delete" class="ui red button myTrigger"><i class="icon delete"></i>Supprimer</button>
		</div>
	<div class="ui container fluid">
		<div class="ui grid padded">	
			<div class="ui row">
				<div class="eight wide column">
					<?php 

					$opatity = "40";

					$reqNiv = $bdd->requeteBDD("SELECT DISTINCT `niveau`,`ordre` FROM `t_division` ORDER BY `ordre` ASC");
					while ($dataNiv =$reqNiv->fetch()){
						$niveau=$dataNiv['niveau'];
						$req = $bdd->requeteBDD("SELECT DISTINCT `nom`,`color` FROM `t_division` WHERE `niveau` = '$niveau' ORDER BY `nom` ASC");						    
					?>
					<table class="ui very compact table">
					  <thead>
						<tr>
							<th><?php echo $niveau; ?> </th>
						  </tr>
						</thead>
					  <tbody>
						<?php 

							while($data = $req->fetch()) { 
							?>
						<tr  class="data_elv" style="background: <?php echo $data['color'] . $opatity; ?>;">
						  <td ><?php echo $data['nom']; ?></td>
						  
						</tr>
						<?php }  ?>
					  </tbody>
					</table>
					<?php }  ?>
		
				</div>
				<div class="eight wide column">
					<table class="ui very compact table">
					  <thead>
						<tr>
							<th>Eleve</th>
						</tr>
					  </thead>
					  <tbody id="data_tbody">
						
						
					  </tbody>
					</table>
				</div>
				<div class="eight wide column">
					<table class="ui very compact table">
					  <thead>
						<tr>
							<th>Fiche élève</th>
							<th></th>
						</tr>
					  </thead>
					  <tbody id="data_tbody_inf">
						
						
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div id="modal_main" class="ui modal">
			  
		</div>
</div>