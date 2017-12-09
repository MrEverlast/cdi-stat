<h2 class="ui header">
  Sélectionner
  <div class="sub header">Les classes de <b>2nd</b>.</div>
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
$i = 0;
$_DIR = $_SERVER['DOCUMENT_ROOT'];
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
?>
    <tr>
      <td class="collapsing ui checkbox" style="width: 100%;">
        <input type="checkbox" class="hidden" data-id="<?php echo $i; ?>">
        <label><?php echo $value; ?></label>
      </td>
    </tr>
    
<?php 
  }
} else {
  echo "No file found";
}
 ?>
   
 </tbody>
</table>
</div>