<?php #----------------- Menu login ---------------# ?>
<div class="ui secondary  menu">
  <div class="right menu">
    <a onclick="afficheModalAdmin()" class="ui item">
      Login
    </a>
  </div>
</div>
<?php #----------------- Menu login end ---------------# ?>

<div class="ui middle aligned center aligned grid">
  <div class="column inscr">
    <h1 class="ui blue image header">CDI</h1>
    <form class="ui large form aligned left">
      <div class="ui stacked segment">
		
				<div class="field" id="divEleve">
					<div class="field">
		      	<div class="ui blue ribbon label large" style="left:-183px;">
			        <i class="user icon"></i> Élève
			      </div>
	      	</div>
					<select id="eleve" class="ui search dropdown" >
						<option value="">Selectionnez l'élève..</option>
						<!--          // BASE //           -->
						<?php 
						$sth = $bdd->requeteBDD("SELECT A.id,`last_name`,`first_name`,`nom` FROM `t_eleve` A INNER JOIN `t_division` B WHERE B.id = A.id_division");
						while($result = $sth->fetch())
						echo "<option value=".$result['id'].">".$result['last_name']." ".$result['first_name']." ".$result['nom']."</option> "; 
						$sth = null;
						?>
						<!--        /////////////////     -->			
					</select>
				</div>
			 
				<div class="field " id="divActivity">
					<div class="field">
		      	<div class="ui blue ribbon label large" style="left:-171px;">
			        <i class="tasks icon"></i> Acitivité
			      </div>
	      	</div>
					<select class="ui search dropdown" id="activity">
						<option value="">Selectionnez l'activité..</option>
						<!--          // BASE //           -->
						<?php 
						$sth = $bdd->requeteBDD("SELECT `id`,`name` FROM `t_activity` ");
						while($result = $sth->fetch())
						echo "<option value=".$result[0].">".$result[1]."</option> "; 
						$sth = null;
						?>
						<!--        /////////////////     -->
					</select>
				</div>
			
				<div class="field" id="divDuree">
					<div class="field">
		      	<div class="ui blue ribbon label large" style="left:-180px;">
			        <i class="hourglass start icon"></i> Durée
			      </div>
	      	</div>
					<select class="ui search dropdown" id="duree">
						<option value="">Selectionnez la durée..</option>
						<!--          // BASE //           -->
						<option value="1">1h</option>
						<option value="2">2h</option>
						<option value="3">3h</option>
						<option value="4">4h</option>
						<!--        /////////////////     -->
					</select>
				</div>
	      <div class="ui fluid large primary submit button" onclick="enregistrerEleve()">
	      	S'enregistrer
	      </div>
      </div>
      <div class="ui error message"></div>
    </form>
  </div>
</div>


<?php #----------------- MODAL ADMIN ---------------# ?>
<div class="ui mini basic modal ">
	<i class="close icon"></i>
  <div class="ui icon header">
    <i class="lock icon"></i>
    Accès documentaliste
  </div>
	<div class="ui center aligned grid ">
	  <div class="ui row">
	    <div id="pass" class="ui left icon input">
				<input type="password" id="password" placeholder="Mot de passe...">
				<i class="lock icon"></i>
		  </div>
	  </div>
	  <div class="ui primary submit button" onclick="enregistrerAdmin()">S'enregistrer</div>
	</div>
</div>
<?php #----------------- MODAL ADMIN END ---------------# ?>
<?php /*-- Pour les selects --*/ ?>
<script type="text/javascript">
  $('select.dropdown').dropdown();
</script>