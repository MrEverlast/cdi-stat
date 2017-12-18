<?php
session_start();

if (
  isset($_SESSION['class']) &&
  isset($_SESSION['class_selected']) &&
  isset($_SESSION['class_niveau']) &&
  isset($_SESSION['class_color'])
) {
  $class_name = ['Seconde','Première','Terminale','BTS'];
  print_r($_SESSION['class_color']);
  ?>
    
    <?php 
    for ($n=0; $n < 4; $n++) {
      $i=0;
      ?> 
    <table class="ui table compact">
    <thead>
      <th><?php echo $class_name[$n]; ?></th>
    </thead>
    <tbody> 
      <?php
      while ($i < count($_SESSION['class'])) {
        if ($n == $_SESSION['class_niveau'][$i]) {
          $class = $_SESSION['class'][$i];
          $color = $_SESSION['class_color'][$n];
          echo "<tr style='background:".$_SESSION['class_color'][$n]."'><td>".$class."</td></tr>";
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
