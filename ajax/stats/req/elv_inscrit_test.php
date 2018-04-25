<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include $_DIR.'/cfg/init.php';

$diff = $_POST['diff'];
$date = $_POST['date'];


$req = "SELECT * FROM `t_activity`";
$while_query = $bdd->requeteBDD($req);
$l = 2;
for($i=0; $i < $diff; $i++) 
  $tabData[1][$i+1] = 0;

while($while_data = $while_query->fetch()) {
  
  $id_activity = $while_data['id'];
  if($while_data['type'] == false) {
    for($i=0; $i < $diff; $i++) {
      $tabData1[$i] = 0;
      $req = "SELECT COUNT(id) AS nb FROM `t_registration` WHERE `id_activity` = $id_activity AND `date_create` BETWEEN DATE_ADD('$date', INTERVAL $i DAY) AND DATE_ADD('$date 23:59:59', INTERVAL $i DAY)";
      $data = $bdd->requeteBDD($req)->fetch();
      $tabData1[$i] += $data['nb'];
    }
  } else {

    for($i=0; $i < $diff; $i++) {
      $tabData1[$i] = 0;
      $req = "SELECT * FROM `t_groupe_join_activity` WHERE `id_activity` = $id_activity AND `date_prog` BETWEEN DATE_ADD('$date', INTERVAL $i DAY) AND DATE_ADD('$date 23:59:59', INTERVAL $i DAY)";
      $query = $bdd->requeteBDD($req);
      while($data = $query->fetch()) {
        $id_groupe = $data['id_groupe'];
        $req = "SELECT * FROM `t_groupe` WHERE `id` = $id_groupe";
        $query = $bdd->requeteBDD($req);
        $res = $query->fetch();
        $id_division = $res['id_division'];
        if ($id_division == null) {
          $req = "SELECT COUNT(id) AS nb FROM `t_eleve_join_groupe` WHERE `id_groupe` = $id_groupe";
          $res = $bdd->requeteBDD($req)->fetch();
        } else {
          $req = "SELECT COUNT(id) AS nb FROM `t_eleve` WHERE `id_division` = $id_division";
          $res = $bdd->requeteBDD($req)->fetch();
        }
        $tabData1[$i] += $res['nb'];
      }
    }
  }
  
  for($i=0; $i < $diff; $i++) {
    $tabData[$l][$i+1] = $tabData1[$i]; 
    $tabData[1][$i+1] += $tabData1[$i];
  }
  $l++;
}



// for ($i=0; $i <= $diff; $i++) {
//   $req = "SELECT COUNT(`id`) AS nb FROM `t_registration` WHERE `date_create` BETWEEN DATE_ADD('$date', INTERVAL $i DAY) AND DATE_ADD('$date 23:59:59', INTERVAL $i DAY)";
//   // "SELECT COUNT(`id`) AS nb FROM `t_registration` WHERE `date_create` BETWEEN '2018-04-21' AND '2018-04-21 23:59:59'";
//   $query = $bdd->requeteBDD($req);
//   $data = $query->fetch();
//   $tabData[$i+1] = $data['nb'];
// }

print_r(json_encode($tabData));