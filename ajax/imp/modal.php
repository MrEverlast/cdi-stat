<?php 
  $_DIR = $_SERVER['DOCUMENT_ROOT']; 
  $_MODAL = $_POST['modal'] - 1;
  $class_name = ['Seconde','Première','Terminale','BTS'];

  if ($_MODAL >= 0 && $_MODAL <= 3){
  ?>

<h2 class="ui header">
  Sélectionnez
  <div class="sub header">Les classes de <b><?php echo $class_name[$_MODAL]; ?></b>.</div>
</h2>

<div class="ui container">

  <table class="ui very compact table">
  <thead>
    <tr>
      <th>Nom de la classe</th>
    </tr>
  </thead>
  <tbody>
    <?php include_once $_DIR.'/ajax/imp/content/list.php'; ?>
  </tbody>
</table>
</div>
<?php 
} elseif ($_MODAL == 4) {
  include_once $_DIR.'/ajax/imp/content/submit.php';
} 
  ?>