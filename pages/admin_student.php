	<h2 class="ui dividing header">
    <i class="users icon"></i>Gestion d'élève
  </h2>
		<div class="ui buttons">
		  <button id="elv_create" class="ui green button myTrigger"><i class="add user icon"></i>Créer</button>
		  <button id="elv_edit" class="ui blue button myTrigger"><i class="user icon"></i>Modifier</button>
		  <button id="elv_delete" class="ui red button myTrigger"><i class="remove user icon"></i>Supprimer</button>
		</div>
<div class="ui container fluid">
	<div class="ui grid padded">
		<div class="row">
				<div class="five wide column">
					<?php 
					$reqNiv = $bdd->requeteBDD("SELECT DISTINCT `niveau`,`ordre` FROM `t_division` ORDER BY `ordre` ASC");
					while ($dataNiv =$reqNiv->fetch()){
						$niveau=$dataNiv['niveau'];
						$req = $bdd->requeteBDD("SELECT DISTINCT `nom`,`color` FROM `t_division` WHERE `niveau` = '$niveau' ORDER BY `nom` ASC");						    
					?>
					<table class="ui very inverted compact table">
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
				<div class="five wide column">
					<table class="ui very inverted compact table">
					  <thead>
						<tr>
							<th>Eleve</th>
						</tr>
					  </thead>
					  <tbody id="data_tbody">
						
						
					  </tbody>
					</table>
				</div>
				<div class="five wide column">
					<table class="ui very inverted compact table">
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
	
	<div id="modal_main" class="ui modal">
			  
		</div>
</div>