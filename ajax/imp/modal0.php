<?php 
  session_start(); 
  unset($_SESSION['class'],$_SESSION['class_selected'],$_SESSION['class_niveau']);
?>
<div class="container" >
  <input type="file" name="file" id="file" accept=".csv">

  <h2 class="ui icon header aligned center">
    <i class="warning icon"></i>
    <div class="content">
      ATTENTION
      <div class="sub header">Veuillez bien configurer le fichier .csv sous la forme</div>
      <div class="sub header"><b>NOM,Prénom,Date de naissance,INE,Ville,Code postal</b></div>
      <div class="sub header">Exemple:</div>
      <div class="sub header"><b>DUPOND,Pierre,31/12/2000,2012112527V,Nice,06000</b></div>
    </div>
  </h2>

  <div class="upload-area"  id="uploadfile">
    <h3>Cliquez pour importer le fichier .csv</h3>
  </div>
</div>
<div id="error" class="ui error message hidden">
  <ul class="list">
    <li>Erreur lors de l'importation du fichier</li>
    <li>Veuillez bien choisir un fichier .csv</li>
  </ul>
</div>