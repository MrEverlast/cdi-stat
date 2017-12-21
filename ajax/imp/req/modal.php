<?php 
	session_start();
	$modal = $_POST['modal'];

	$selected = json_decode($_POST['selected']);

	for($i=0; $i<count($selected); $i++) {
		if ($selected[$i] == 'true') {
			$_SESSION['class_selected'][$i] = 'true';
		}
	}

	switch ($modal) {
		case '2':
			init('0');
			break;
		case '3':
			init('1');
			break;
		case '4':
			init('2');
			break;
		case '5':
			init('3');
			break;
		
		default:
			print_r($modal);
			break;
	}

	function init($class)
	{
		for ($i=0; $i < count($_SESSION['class_selected']); $i++) {
			if ($_SESSION['class_selected'][$i] == 'true'){
				$_SESSION['class_niveau'][$i] = $class;
			}
		}
		resetSelected();
	}

	function resetSelected()
	{
		for ($i=0; $i <= count($_SESSION['class']); $i++) {
			$_SESSION['class_selected'][$i] = 'false';
		}
	}
 ?>