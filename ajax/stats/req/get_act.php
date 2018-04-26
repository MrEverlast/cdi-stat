<?php

$_DIR = $_SERVER['DOCUMENT_ROOT'];
include $_DIR.'/cfg/init.php';


$req = "SELECT * FROM `t_activity`";
$l = 1;
$query = $bdd->requeteBDD($req);
while($data = $query->fetch(PDO::FETCH_ASSOC)) {
  $res[$l] = $data;
  $l++;
}
print_r(json_encode($res));