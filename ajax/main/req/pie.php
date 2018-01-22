<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];

require $_DIR.'/cfg/init.php';

for ($n=0; $n < 4; $n++) { 
  $nb = 0;
  
  for ($i=1; $i <= 4; $i++) { 
    $req = "SELECT COUNT(A.`id`) AS nb
            FROM `t_registration` AS A
            INNER JOIN `t_eleve` AS B ON A.id_eleve = B.id
            INNER JOIN `t_division` AS C ON C.`id` = B.`id_division`
            WHERE NOW() < ADDDATE(`date_create`, INTERVAL $i HOUR) AND `duration` = $i AND C.`ordre` = $n";
    $query = $bdd->requeteBDD($req);
    $data = $query->fetch();
    $nb += $data['nb'];
  }

  $tabEleve[$n] = $nb;
}
print_r(json_encode($tabEleve));
