<?php
$_DIR = $_SERVER['DOCUMENT_ROOT'];
include $_DIR.'/cfg/init.php';

$date = $_POST['date'];

$req = "SELECT WEEK('$date') AS `first_week`, WEEK(LAST_DAY('$date')) AS `last_week`";
$query = $bdd->requeteBDD($req);

print_r(json_encode($query->fetch(PDO::FETCH_NAMED)));