<?php
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include $_DIR.'/cfg/init.php';

for ($i=1; $i <= 12; $i++) { 
  $req = "SELECT COUNT(`id`) AS nb FROM `t_registration` WHERE MONTH(`date_create`) = $i";
  $query = $bdd->requeteBDD($req);
  $data = $query->fetch();
  $tabData[$i] = $data['nb'];
}
for ($n=0; $n < 8; $n++) { 
  array_push($tabData, array_shift($tabData));
}
print_r(json_encode($tabData));