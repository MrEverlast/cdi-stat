<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include $_DIR.'/cfg/init.php';

$diff = $_POST['diff'];
$date = $_POST['date'];


for ($i=0; $i < $diff; $i++) {
  $req = "SELECT COUNT(`id`) AS nb FROM `t_registration` WHERE `date_create` = DATE_ADD('$date', INTERVAL $i DAY)";
  $query = $bdd->requeteBDD($req);
  $data = $query->fetch();
  $tabData[$i+1] = $data['nb'];
}

print_r(json_encode($tabData));