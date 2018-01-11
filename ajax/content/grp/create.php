<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
		<div class="two fields">
		  <div class="field">
		    <label>Nom du groupe</label>
		    <input id="grp_name" type="text" autocomplete="none">
		  </div>
		</div>
		<div class="field">
				<label>Ajouter des élèves</label>
			  <select id="id_elevs" class="ui fluid search dropdown" multiple="">
					<option value="">Elèves</option>
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
		
	</div>
</div>
