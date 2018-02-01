<?php 
// $_DIR = $_SERVER['DOCUMENT_ROOT'];
// include $_DIR.'/cfg/init.php';

// $weekFirst = $_POST['weekFirst'];
// $weekDiff = $_POST['weekDiff'];
// $month = $_POST['month'];

// for ($i=0; $i < 7; $i++) {
//   $week = $weekFirst + $i;
//   $req = "SELECT COUNT(`id`) AS nb FROM `t_registration` WHERE DAY(`date_create`) = $week AND MONTH(`date_create`) = $month";
//   $query = $bdd->requeteBDD($req);
//   $data = $query->fetch();
//   $tabData[$i+1] = $data['nb'];
// }

// print_r(json_encode($tabData));