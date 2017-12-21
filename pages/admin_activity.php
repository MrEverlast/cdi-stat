<div class="ui basic segment">
	<h2 class="ui dividing header">
    Gestion d'activité
  </h2>
			<div class="ui buttons">
				<button id="act_create" class="ui green button myTrigger"><i class="icon add"></i>Créer</button>
				<button id="act_edit" class="ui blue button myTrigger"><i class="icon edit"></i>Modifier</button>
				<button id="act_delete" class="ui red button myTrigger"><i class="icon delete"></i>Supprimer</button>
			</div>
<div class="ui container fluid">
	<div class="ui grid padded">
		<div class="row">
			
			<div class="five wide column">
				<?php 
					$i = 0;
					$type="Seul";
					while ($i < 2) {
						$req = $bdd->requeteBDD("SELECT * FROM `t_activity` WHERE `type` = $i");
					?>
						<table class="ui very inverted compact table">
						  <thead>
						    <tr>
							    <th>Activité</th>
							    <th class="right aligned"><?php echo $type ?></th>
							  </tr>
							</thead>
						  <tbody>
							<?php 
								while($data = $req->fetch()) { 
								?>
						    <tr style="background: <?php echo $data['color'] . $opatity; ?>;">
						      <td colspan=2 ><?php echo $data['name']; ?></td>
						     
						    </tr>
							<?php } ?>
						  </tbody>
						</table>
					<?php 
						$i++;
						$type="Groupe";
					}
					 ?>
			</div>

			<div class="five wide column">
				<table class="ui very inverted compact table">
					<thead>
						<tr>
							<th>Description</th>
						</tr>
					</thead>
					<tbody id="data_grp"></tbody>
				</table>
			</div>

			<div class="five wide column">
				<table class="ui very inverted compact table">
					<thead>
						<tr>
							<th>Grp</th>
						</tr>
					</thead>
					<tbody id="data_grp"></tbody>
				</table>
			</div>

		</div>
	</div>
</div>

<div id="modal_main" class="ui modal"></div>
</div>
