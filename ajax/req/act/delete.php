<?php 
$idActivity = $_POST['idActivity'];

$query = "DELETE FROM `t_activity` WHERE `t_activity`.`id` = $idActivity";

$bdd->requeteBDD($query);