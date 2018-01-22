<?php 

$_DIR = $_SERVER['DOCUMENT_ROOT'];

include $_DIR.'/cfg/init.php';

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Print</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/assets/css/semantic.min.css" />
</head>
<body>
<div class="ui container">
    <div class="ui text container">
      <h1 class="ui header">
        Liste des élèves présents au CDI
      </h1>
    </div>
  <table class="ui very compact table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Classe</th>
        <th>Heure d'arrivé</th>
        <th>Temps</th>
        <th>Activité</th>
      </tr>
    </thead>
    <tbody id="tList">
      <?php include $_DIR."/ajax/main/req/listEleve.php"; ?>
    </tbody>
  </table>
</div>
</body>
</html>