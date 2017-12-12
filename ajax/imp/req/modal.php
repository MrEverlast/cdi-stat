<?php 
	session_start();
	$modal = $_POST['modal'];
	//$_SESSION['class_selected'] = $_POST['selected'];

	$selected = json_decode($_POST['selected']);


	for($i=0; $i<count($selected); $i++) {
		if ($selected[$i] == true) {
			$_SESSION['class_selected'][$i] = true;
		}
	}

	print_r($_SESSION['class_selected']);

	switch ($modal) {
		case '2':
			init2nd();
			break;
		
		default:
			# code...
			break;
	}


	function init2nd()
	{
		$i=0;
		while ($i < count($_SESSION['class_selected'])) {
			if ($_SESSION['class_selected'][$i] == true)
				$_SESSION['class_niveau'][$i] = 0;
			$i++;
		}
		resetSelected();
	}

	function resetSelected()
	{
		$i=0;
		while ($i < count($_SESSION['class_selected'])) {
			$_SESSION['class_selected'][$i] = false;
			$i++;
		}
	}
 ?>