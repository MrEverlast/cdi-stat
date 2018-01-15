<?php
session_start();

$json = file_get_contents($_DIR.'/cfg/config.json'); // Fichier de cfg
$json = json_decode($json,true); // Transformation du fichier en array

$tabColor = $json['color'];

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
  isset($_SESSION['class_niveau'])
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
          $color = $tabColor[$level_name[$n]] . $json['color']['opacity'];
          echo "<tr style='background: ".$color."'><td>".$class."</td></tr>";
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
