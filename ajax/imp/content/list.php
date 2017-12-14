<?php 
session_start();

if ($file = fopen($_DIR."/ajax/tmp/student.csv", "r")) {
  $i=0;
  while(!feof($file)) {
    $line = fgets($file);
    $test = explode(",", $line);
    $table[$i] = $test[4];
    $i++;
  }
  fclose($file);
  $class = array_unique($table);
  array_shift($class);
  array_pop($class);
  sort($class);
  $i = 0;
  foreach ($class as $key => $value) {
    
    if (!isset($_SESSION['class'][$i])) {
      $_SESSION['class'][$i] = $value;
    } 

    if (!isset($_SESSION['class_selected'][$i])) {
      $_SESSION['class_selected'][$i] = 'false';
    } 

    if (!isset($_SESSION['class_niveau'][$i])) {
      $_SESSION['class_niveau'][$i] = -1;
    } 

    if ($_SESSION['class_niveau'][$i] != -1) {
      if ($_MODAL != $_SESSION['class_niveau'][$i]) {
        $class_selected = "disabled";
        $checked = "";
      } else {
        $class_selected = "checked";
        $checked = 'checked=""';
      }
    } else {
      $class_selected = "";
      $checked = "";
    }

?>
    <tr>
      <td class="collapsing ui checkbox <?php echo $class_selected; ?>" style="width: 100%;">
        <input type="checkbox" class="hidden" <?php echo $checked; ?> data-id="<?php echo $i; ?>">
        <label><?php echo $value; ?></label>
      </td>
    </tr>
    
<?php 
$i++;
  }
} else {
  echo "No file found";
}
 ?>