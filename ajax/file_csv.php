<?php
$_DIR = $_SERVER['DOCUMENT_ROOT'];
$uploads_dir = $_DIR.'/ajax/tmp';

$name = "student.csv";

$tmp_name = $_FILES["file"]["tmp_name"];
mkdir($uploads_dir);
chmod($uploads_dir, 777);
move_uploaded_file($tmp_name, "$uploads_dir/$name");

echo "true";