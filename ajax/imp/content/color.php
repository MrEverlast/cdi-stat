<h2 class="ui header">
  Sélectionnez
  <div class="sub header">Les couleurs de chaque <b>niveau</b>.</div>
</h2>
<?php for ($b=0; $b < count($class_name); $b++) { ?>
  <h3 class="ui header">
    <?php echo $class_name[$b]; ?>
  </h3>
  <button id="color<?php echo $b; ?>" class="ui button"></button>
<?php } ?>