<?php 

if((isset($_POST['eleve'])) && (!empty($_POST['eleve'])) && (isset($_POST['activity'])) && 
	(!empty($_POST['activity'])) && (isset($_POST['duree'])) && (!empty($_POST['duree'])) ){

	$today = date("Y-m-d H:i:s"); 	
	$sth = $bdd->requeteBDD("INSERT INTO `t_registration`(`id_eleve`, `id_activity`,`date_create`,`duration`)
							VALUES (".$_POST['eleve'].",".$_POST['activity'].",'$today',".$_POST['duree'].")");
						
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
	echo "1";
}

?>
