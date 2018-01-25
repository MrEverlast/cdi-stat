<?php 
	if(isset($_POST['id_acti'])){
		
		$id_acti = $_POST['id_acti'];
		$query = "SELECT * FROM `t_activity` A WHERE A.id='$id_acti' ";
		$sth = $bdd->requeteBDD($query);
		while($data = $sth->fetch()){
			$response = $data['name']." ".$data['color']." ".$data['type'];
		}
		echo $response;
	}
	if(isset($_POST['name'])){
		$name = $_POST['name'];
		$color = $_POST['color'];
		$type = $_POST['type'];
		$idActivity = $_POST['idActivity'];

		$query = "UPDATE `t_activity` SET `name` = '$name', `color` = '$color', `type` = $type WHERE `id` = $idActivity";

		$bdd->requeteBDD($query);
	}