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
		isset($_SESSION['class_niveau'])
	) {
		try {
			$bdd = new PDO("mysql:host=".$ip, $user, $password);
			$bdd->exec('SET NAMES utf8');
			
			$bdd->exec("CREATE DATABASE `$bddName`;");

			$bdd->query("use $bddName");

			$import = file_get_contents($_DIR.'/cfg/import.sql');
			$path_bdd_name = 
			$wait = 1;
			$wait = $bdd->exec($import);

			while ($wait != 0) {
			}

			insertDivision($bdd,$json);
			insertGrp($bdd);
			
			$json['BDD'] = $bddName;
			$json = json_encode($json);
			file_put_contents($_DIR.'/cfg/config.json', $json);
			file_put_contents($_DIR.'/cfg/nom_bdd.txt', $bddName);
			
			//insertAllData();

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

	function insertDivision(PDO $bdd, $json) {
		$level_name = ['Seconde','Première','Terminale','BTS'];
		$tabcolor = $json['color'];
		$i=0;
		$max = count($_SESSION['class']);
		while($i < $max){
			$statement = $bdd->prepare("INSERT INTO `t_division` (`id`, `nom`, `niveau`, `color`, `ordre`) VALUES (NULL, ?, ?, ?, ?);");
			$n = $_SESSION['class_niveau'][$i];
			$color = $tabcolor[$level_name[$n]];

			$statement->execute([
				$_SESSION['class'][$i],
				$level_name[$n],
				$color,
				$n
				]);

			//  (NULL, 'erq55', 'Terminale', '#321456', '0')
			$i++;
		}

	}

	function insertGrp(PDO $bdd) {
		$statement = $bdd->prepare("INSERT INTO `t_groupe` (`id`, `name`, `date_create`, `id_division`) VALUES (NULL, ?, ?, ?);");
	
		$max = count($_SESSION['class']);
		
		for($i = 0; $i < $max; $i++) {
			$name = $_SESSION['class'][$i];
			$req = $bdd->prepare("SELECT `id` FROM t_division WHERE `nom` = '$name'");
			$req->execute();
			$division = $req->fetch();
			$id = $division['id'];
			
			for ($n=1; $n <= 2; $n++) {
				$date = date("Y-m-d H:i:s");
				$groupe = 'Groupe '.$n;
				$statement->execute([
					$groupe, 
					$date,
					$id
				]);
			}
		}
		insertAllStudent($bdd);
	}

	function convertDate($date) {
		$data = date_parse_from_format("d/m/Y", $date);
		return $data['year']."-".$data['month']."-".$data['day'];
	}

	function insertAllStudent(PDO $bdd) {
		$_DIR = $_SERVER['DOCUMENT_ROOT'];
		if ($file = fopen($_DIR."/ajax/tmp/student.csv", "r")) {
			while(!feof($file)) {
				$line = fgets($file);
				$test = explode(",", $line);

				$last_name = $test[0];
				$first_name = $test[1];
				$date = convertDate($test[2]);
				$name = $test[4];
				$city = $test[5];
				$post_code = $test[6];
				
				$id_division = getDivisionId($bdd, $name);

				$statement = $bdd->prepare("INSERT INTO `t_eleve` (`id`, `last_name`, `first_name`, `date_born`, `city`, `post_code`, `id_division`) VALUES (NULL, ?, ?, ?, ?, ?, ?);");

				$statement->execute([
					$last_name, 
					$first_name, 
					$date, 
					$city, 
					$post_code, 
					$id_division
				]);
			}
			fclose($file);
			insertEleveGroup($bdd);
		}

	}

	function insertEleveGroup($bdd) {
		$n = count($_SESSION['class']);
		for ($i=0; $i < $n; $i++) {
			$name = $_SESSION['class'][$i];
			$id_division = getDivisionId($bdd, $name);
			$req = $bdd->prepare("SELECT * FROM `t_eleve` WHERE `id_division` = '$id_division'");
			$req->execute();
			$count = $req->rowCount();

			$reqGrp = $bdd->prepare("SELECT `id` FROM `t_groupe` WHERE `id_division` = '$id_division'");
			$reqGrp->execute();
			$groupe = $reqGrp->fetch();
			$id_groupe = $groupe['id'];
			
			$l=0;
			while ($data = $req->fetch()) {
				$id = $data['id'];
				if ($l < $count/2) {
					$bdd->exec("UPDATE `t_eleve` SET `id_demigroupe` = '$id_groupe' WHERE `t_eleve`.`id` = $id;");
					// UPDATE `t_eleve` SET `id_demigroupe` = '1' WHERE `t_eleve`.`id` = 1;
				} else {
					$id_groupe2 = $id_groupe+1;
					$bdd->exec("UPDATE `t_eleve` SET `id_demigroupe` = '$id_groupe2' WHERE `t_eleve`.`id` = $id;");
				}
				$l++;
			}
		}



	}

	function getDivisionId(PDO $bdd, $name) {
		$req = $bdd->prepare("SELECT `id` FROM t_division WHERE `nom` = '$name'");
		$req->execute();
		$division = $req->fetch();
		return $division['id'];
	}

	echo $wait;


	// IMPORT divisons: 
	// 		"INSERT INTO `t_division` (`id`, `nom`, `niveau`, `color`, `ordre`) VALUES (NULL, 'erq55', 'Terminale', '#321456', '0');"
	// IMPORT groupes: 
	// 		"INSERT INTO `t_groupe` (`id`, `name`, `date_create`, `color`, `id_division`) VALUES (NULL, 'ddddd', '2018-01-11 00:00:00', '#321456', '9');"
	// IMPORT eleves: 
	// 		"INSERT INTO `t_eleve` (`id`, `last_name`, `first_name`, `date_born`, `city`, `post_code`, `id_division`, `id_demigroupe`) VALUES (NULL, 'BROOKS', 'max', '2018-01-01', 'le thoronet', '83340', '9', '4');"
 ?>