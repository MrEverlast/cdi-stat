<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
require $_DIR."/cfg/init.php";

for ($i=1; $i <= 4; $i++) { 
              
  $req = "SELECT A.date_create, A.duration, B.last_name, B.first_name, C.name, D.nom
          FROM `t_registration` AS A
          INNER JOIN `t_eleve` AS B ON A.`id_eleve` = B.`id`
          INNER JOIN `t_activity` AS C ON A.`id_activity` = C.`id`
          INNER JOIN `t_division` AS D ON B.`id_division` = D.`id`
          WHERE NOW() < ADDDATE(A.`date_create`, INTERVAL $i HOUR) AND A.`duration` = $i";

  $statement = $bdd->requeteBDD($req);
  while ($data = $statement->fetch()) {
    $date = new DateTime($data['date_create']);
    $date = $date->getTimestamp();
    echo "<tr>";
    echo "<td>".$data['last_name']."</td>";
    echo "<td>".$data['first_name']."</td>";
    echo "<td>".$data['nom']."</td>";
    echo "<td>".date("H\hi", $date)."</td>";
    echo "<td>".$data['duration']."h</td>";
    echo "<td>".$data['name']."</td>";
    echo "<tr>";
  }
}