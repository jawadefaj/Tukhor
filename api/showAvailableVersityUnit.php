<?php
require_once __DIR__."/../class/VersityFinder.php";

$result = array(
	'success' => true,
	'message' => '',
	'versities' => []
);

$finder = new VersityFinder();

try {
	if (isset($_POST['subjectList']) && isset($_POST['gradeList']) && isset($_POST['background'])) {
		$result['versities'] = $finder->showAvailableVersityUnit($_POST['subjectList'], $_POST['gradeList'], $_POST['background']);
	}
	else {
		$result['success'] = false;
		$result['message'] = "Data not passed";	
	}
} catch (Exception $ex) {
	$result['success'] = false;
	$result['message'] = $ex->getMessage();
}

echo json_encode($result);
die();
?>