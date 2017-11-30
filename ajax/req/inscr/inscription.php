<?php 

if((isset($_POST['eleve'])) && (!empty($_POST['eleve'])) && (isset($_POST['activity'])) && 
	(!empty($_POST['activity'])) && (isset($_POST['duree'])) && (!empty($_POST['duree'])) ){
		
	$sth = $bdd->requeteBDD("INSERT INTO `t_registration`(`id_eleve`, `id_activity`,`duration`)
							VALUES (".$_POST['eleve'].",".$_POST['activity'].",".$_POST['duree'].")");
						
}

if((isset($_POST['password'])) && (!empty($_POST['password']))){
	$sth = $bdd->requeteBDD("SELECT `password` FROM `t_password`");
	while($result = $sth->fetch()){
		if($_POST['password'] == $result[0]){ 
			session_start();
			$_SESSION["connected"]=true;
			header('Location:/main');
			
		}
	}
}

?>
