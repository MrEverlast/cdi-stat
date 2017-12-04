<?php
$_DIR = $_SERVER['DOCUMENT_ROOT'];
$uploads_dir = $_DIR.'/ajax/tmp';

$tmp_name = $_FILES["file"]["tmp_name"];
$name = $_FILES["file"]["name"];
mkdir($uploads_dir);
chmod($uploads_dir, 777);
move_uploaded_file($tmp_name, "$uploads_dir/$name");

echo json_encode($filename);