<?php 
    $mdpactuel = $_POST['mdpactuel'];
    $newmdp = $_POST['newmdp'];
    $confirm_mdp = $_POST['confirmmdp'];

    $data_retourne="1";
    $query = "SELECT * FROM `t_password` WHERE `password`='$mdpactuel'";
    $result = $bdd->requeteBDD($query);
    while($data = $result->fetch()){
        
            if($newmdp == $confirm_mdp){    
                $id =$data['id'];
                if($id =='1'){
                    $query2="INSERT INTO `t_password` (`password`) VALUES ('$newmdp')";
                    
                } else {
                    $query2="UPDATE `t_password` SET `password`='$newmdp' WHERE `id`='$id'";
                }
                $bdd->requeteBDD($query2);
                $data_retourne ="0";
            } else {
                $data_retourne ="2";
            }

    }
    ECHO $data_retourne;