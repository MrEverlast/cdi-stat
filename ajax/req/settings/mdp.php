<?php 
    $mdpactuel = $_POST['mdpactuel'];
    $newmdp = $_POST['newmdp'];
    $confirm_mdp = $_POST['confirmmdp'];

    $data_retourne="1";
	
	$query = "SELECT COUNT(*) as nb FROM `t_password` WHERE 1";
	$res = $bdd->requeteBDD($query)->fetchAll()[0];
	$nb = $res['nb'];

    $query = "SELECT * FROM `t_password` WHERE `password`='$mdpactuel'";
    $result = $bdd->requeteBDD($query);
    while($data = $result->fetch()){
		$default_pass = $data['default_pass'];
    }
	if($newmdp == $confirm_mdp){    
                
		if( $default_pass == 1){
			if($nb > 1) {
				$query2="UPDATE `t_password` SET `password`='$newmdp' WHERE `default_pass`=0";
            } else {
				$query2="INSERT INTO `t_password` (`password`) VALUES ('$newmdp')";
			}
        } else {
            $query2="UPDATE `t_password` SET `password`='$newmdp' WHERE `default_pass`=0";
        }
            $bdd->requeteBDD($query2);
            $data_retourne ="0";
        } else {
            $data_retourne ="2";
    }
    ECHO $data_retourne;