<h2 class="ui header">
  Sélectionner
  <div class="sub header">Les classes de <b>2nd</b>.</div>
</h2>
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
  foreach ($class as $key => $value) {
    echo $value."<br>";
  }
} else {
  echo "No file found";
}
 ?>