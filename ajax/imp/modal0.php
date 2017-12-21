<?php 
  session_start(); 
  unset($_SESSION['class'],$_SESSION['class_selected'],$_SESSION['class_niveau'],$_SESSION['class_color']); 
  $_SESSION['class_color'] = array('EBEB0040', '00D70040', 'D7000040', '0000D740');
?>
<div class="container" >
  <input type="file" name="file" id="file" accept=".csv">

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