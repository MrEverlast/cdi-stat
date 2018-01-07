<?php 
	session_start();
	$_DIR = $_SERVER['DOCUMENT_ROOT'];
	$bddName = $_POST['bddName']."_".getSchoolYear();

	$json = file_get_contents($_DIR.'/cfg/config.json'); // Fichier de cfg
	$json = json_decode($json,true); // Transformation du fichier en array
	
	$ip = $json['ip'];
	$user = $json['user'];
	$password = $json['password'];
	$port = $json['port'];

	if (
		isset($_SESSION['class']) &&
		isset($_SESSION['class_selected']) &&
		isset($_SESSION['class_niveau']) &&
		isset($_SESSION['class_color'])
	) {
		try {
			$bdd = new PDO("mysql:host=".$ip, $user, $password);
			
			$bdd->exec("CREATE DATABASE `$bddName`;");

			$bdd->query("use $bddName");

			$import = file_get_contents($_DIR.'/cfg/import.sql');
			$bdd->exec($import);

			$json['BDD'] = $bddName;
			$json = json_encode($json);
			file_put_contents($_DIR.'/cfg/config.json', $json);

			insertAllData();

		} catch(PDOExeption $e) {
			print_r($e);
		}
	}

	function getSchoolYear() {
		$date = explode(':', date('Y:n'));
		$year = $date[0];
		$month = $date[1];
		if ($month > 8) $year++;
		return $year;
	}

	function insertDivision(PDO $bdd) {
		// $i=0;
		// while($_SESSION['class'][$i]){
		// 	$bdd->prepare("INSERT INTO `t_division` (`id`, `nom`, `niveau`, `color`, `ordre`) 
		// 									VALUES (NULL, 'erq55', 'Terminale', '#321456', '1');");
											
		// 	$i++;
		// }

	}

	function insertAllStudent(PDO $bdd) {


		if ($file = fopen($_DIR."/tmp/student.csv", "r")) {
			while(!feof($file)) {
				$line = fgets($file);
				$test = explode(",", $line);

				$bdd->prepare("INSERT INTO ");
			}
			fclose($file);
		}
		
		$bdd;
	}
 ?>