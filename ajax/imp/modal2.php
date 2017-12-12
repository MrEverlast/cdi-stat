<?php 
$i = 0;
$_DIR = $_SERVER['DOCUMENT_ROOT'];


 ?>

<h2 class="ui header">
  Sélectionner
  <div class="sub header">Les classes de <b>1er</b>.</div>
</h2>

<div class="ui container">

  <table class="ui very compact table">
  <thead>
    <tr>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
  
<?php 

if ($file = fopen($_DIR."/ajax/tmp/student.csv", "r")) {
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
    $i++;
    if (!isset($_SESSION['class'][$i]) && !isset($_SESSION['class_selected'][$i])) {
    	$_SESSION['class'][$i] = $value;
    	$_SESSION['class_selected'][$i] = false;
      $_SESSION['class_niveau'][$i] = -1;
    }
    if ($_SESSION['class_niveau'][$i] != -1) {
      $class_selected = "disabled";
    } else {
      $class_selected = "";
    }
?>
    <tr>
      <td class="collapsing ui checkbox <?php echo $class_selected; ?>" style="width: 100%;">
        <input type="checkbox" class="hidden" data-id="<?php echo $i; ?>">
        <label><?php echo $value; ?></label>
      </td>
    </tr>
    
<?php 
  }
  print_r($_SESSION['class']);
  echo "<br>";
  print_r($_SESSION['class_selected']);
  echo "<br>";
  print_r($_SESSION['class_niveau']);
  echo "<br>";
} else {
  echo "No file found";
}
 ?>
   
  </tbody>
</table>
</div>