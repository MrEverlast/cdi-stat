<?php 
/*
$_DIR = $_SERVER['DOCUMENT_ROOT'];

$test = file_get_contents($_DIR.'/cfg/config.json');

$json = json_decode($test,true);
echo $json['BDD'];
*/
$i = 0;
if ($file = fopen("Eleve - import.csv", "r")) {
    while(!feof($file)) {
        $line = fgets($file);
        $test = explode(",", $line);
		$table[$i] = $test[4];
       // echo $test[4] . '<br>';
	    
		$i++;
    }
    fclose($file);
	//print_r(array_unique($table));
}
$class = array_unique($table);
sort($class);
foreach ($class as $key => $value) {
	echo $value."<br>";
}
//print_r($prout);
 ?>