<?php session_start(); unset($_SESSION['class'],$_SESSION['class_selected'],$_SESSION['class_niveau']); ?>
<div class="container" >
  <input type="file" name="file" id="file" accept=".csv">
  
  <!-- Drag and Drop container-->
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