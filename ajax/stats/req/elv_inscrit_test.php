<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include $_DIR.'/cfg/init.php';

$diff = $_POST['diff'];
$date = $_POST['date'];


for ($i=0; $i <= $diff; $i++) {
  $req = "SELECT COUNT(`id`) AS nb FROM `t_registration` WHERE `date_create` BETWEEN DATE_ADD('$date', INTERVAL $i DAY) AND DATE_ADD('$date 23:59:59', INTERVAL $i DAY)";
  // "SELECT COUNT(`id`) AS nb FROM `t_registration` WHERE `date_create` BETWEEN '2018-04-21' AND '2018-04-21 23:59:59'";
  $query = $bdd->requeteBDD($req);
  $data = $query->fetch();
  $tabData[$i+1] = $data['nb'];
}

print_r(json_encode($tabData));