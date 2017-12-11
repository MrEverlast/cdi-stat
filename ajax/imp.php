<?php 
unset($_SESSION['class'],
      $_SESSION['class_selected'],
      $_SESSION['class_niveau']);
   ?>
<div id="modal_year" class="ui modal" data-page="0" style="height: 80%;">

  <div class="content scrolling" style="max-height: calc(100% - 64px);">
    <?php include_once $_DIR.'/ajax/imp/modal0.php'; ?>
  </div>

  <div class="actions" style="bottom: 0;width: 100%;position: absolute;">
    <button class="ui button cancel red"><i class="icon delete"></i>Annuler</button>
    <button id="previous" class="ui button disabled"><i class="icon chevron left"></i>Précédent</button>
    <button id="next" class="ui button disabled">Suivant<i class="icon chevron right"></i></button>
  </div>  

</div>
