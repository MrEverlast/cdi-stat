<?php 

		$id_eleve = $_POST['id_eleve'];


		$query = "SELECT * FROM `t_eleve` A INNER JOIN `t_division` B ON B.id=A.id_division WHERE A.id='$id_eleve'";

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
			echo $result['last_name']."_".$result['first_name']."_".$result['city']."_".$result['post_code']."_".$result['nom']."_".$ndate."_";
			
		}

	$city = $_POST['city'];
	$post_code = $_POST['postal_code'];
	$classe = $_POST['classe'];
	$date_born = $_POST['date_born'];
	$id_elev = $_POST['id_elev'];

	
	/*
	$query = "SELECT * FROM `t_division` WHERE `nom`='$classe'";
	$sth = $bdd->requeteBDD($query);
	while($result = $sth->fetch()){
			$id_division = $result['id'];
		}

	if($date_born != ""){
				$datejr = date($result['date_born']);
				$jour = substr($datejr, 0, 2);
				$mois = substr($datejr, 3, 2);
				$annnee = substr($datejr, 6, 4);
				$date_born = $annnee.'-'.$mois.'-'.$jour;
			}
		
	$query = "UPDATE `t_eleve` SET `city`='$city', `post_code`='$postal_code', `id_division`='$id_division', `date_born`='$date_born' 
			WHERE `id`=$id_elev";
	
	$sth = $bdd->requeteBDD($query);
	*/
 ?>