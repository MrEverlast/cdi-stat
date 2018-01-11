<?php
session_start();

function getSchoolYear() {
  $date = explode(':', date('Y:n'));
  $year = $date[0];
  $month = $date[1];
  if ($month > 8) $year++;
  return $year;
}

if (
  isset($_SESSION['class']) &&
  isset($_SESSION['class_selected']) &&
  isset($_SESSION['class_niveau']) &&
  isset($_SESSION['class_color'])
  ) {
  $level_name = ['Seconde','Première','Terminale','BTS'];
  ?>
    <div class="ui right fluid labeled input">
      <input id="bddName" type="text" placeholder="Nom de la base de données">
      <div class="ui basic label"><?php echo getSchoolYear(); ?></div>
    </div>
    <?php 
    for ($n=0; $n < 4; $n++) {
      $i=0;
      ?> 
    <table class="ui table compact">
    <thead>
      <th><?php echo $level_name[$n]; ?></th>
    </thead>
    <tbody> 
      <?php
      while ($i < count($_SESSION['class'])) {
        if ($n == $_SESSION['class_niveau'][$i]) {
          $class = $_SESSION['class'][$i];
          $color = $_SESSION['class_color'][$n];
          echo "<tr style='background: #".$_SESSION['class_color'][$n]."'><td>".$class."</td></tr>";
        }
        $i++;
      }
    ?>
    </tbody>
    <?php
    }
      ?>
    
  </table>
  <?php
}
