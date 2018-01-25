<?php 

		if(isset($_POST['id_eleve'])){
			$id_eleve = $_POST['id_eleve'];


			$query = "SELECT A.last_name,A.first_name,A.city,A.post_code,B.nom,A.date_born,C.name,C.id_division 
					FROM `t_eleve` A 
					INNER JOIN `t_division` B ON B.id=A.id_division 
					INNER JOIN `t_groupe` C ON C.id=A.id_demigroupe 
					WHERE A.id='$id_eleve'";

			$sth = $bdd->requeteBDD($query);
			while($result = $sth->fetch()){
				if($result['date_born'] != ""){
					$datejr = date($result['date_born']);
					$annnee = substr($datejr, 0, 4);
					$mois = substr($datejr, 5, 2);
					$jour = substr($datejr, 8, 2);
					$ndate = $jour.'/'.$mois.'/'.$annnee;
				}
				else $ndate = "";
				echo $result['last_name']."_".$result['first_name']."_".$result['city']."_".$result['post_code']."_".$result['nom']."_".$ndate."_".$result['name']."_";
				
			}
			$sth=NULL;
		}

	$city = $_POST['city'];
	$post_code = $_POST['post_code'];
	$classe = $_POST['classe'];
	$date_born = $_POST['date_born'];
	$id_elev = $_POST['id_elev'];
	$demi_grp= $_POST['demi_grp'];

	
	
	$query = "SELECT * FROM `t_division` WHERE `nom`='$classe'";
	$sth = $bdd->requeteBDD($query);
	while($result = $sth->fetch()){
			$id_division = $result['id'];
		}
	
	$query = "SELECT * FROM `t_groupe` WHERE `name`='$demi_grp' AND `id_division`='$id_division' ";
	$sth = $bdd->requeteBDD($query);
	while($result = $sth->fetch()){
			$id_demi_grp = $result['id'];
		}

	$ts = DateTime::createFromFormat('d/m/Y', $date_born);
	$date_born = $ts->format('Y-m-d');
			
		
	$query = "UPDATE `t_eleve` SET `city`='$city', `post_code`='$post_code', `id_division`='$id_division', `date_born`='$date_born', `id_demigroupe`='$id_demi_grp' 
			WHERE `id`=$id_elev";
	
	$sth = $bdd->requeteBDD($query);
	
	
	
 ?>