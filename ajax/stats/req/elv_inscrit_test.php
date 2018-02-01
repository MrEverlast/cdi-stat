<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include $_DIR.'/cfg/init.php';

$diff = $_POST[''];
$date = $_POST[''];


for ($i=0; $i < $weekDiff; $i++) {
  $req = "SELECT COUNT(`id`) AS nb FROM `t_registration` WHERE WEEK(`date_create`) = $week AND MONTH(`date_create`) = $month";
  $query = $bdd->requeteBDD($req);
  $data = $query->fetch();
  $tabData[$i+1] = $data['nb'];
}

print_r(json_encode($tabData));