<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include_once $_DIR.'/cfg/init.php'; 
  ?>
<div class="content">
	<div class="ui form">
	  <div class="field">

		<label>Groupes</label>
			<select id="id_grp" data_delgrp="req_grp_delete" class="ui search dropdown">
				<option value="">Sélectionner un groupe</option>
				<?php 
				$req = $bdd->requeteBDD("SELECT DISTINCT * FROM `t_groupe` WHERE `id_division` is NULL ORDER BY `date_create` ASC"); 
				
					while($data = $req->fetch()) { 
					?> 
					<option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
					<?php
					}
				?>
			</select>
	  </div>
    
	</div>
</div>