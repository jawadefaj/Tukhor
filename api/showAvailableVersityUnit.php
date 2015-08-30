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
	/*else {
		$result['versities'] = $finder->showAvailableVersityUnit(array("Bangla", "English", "Physics", "Chemistry", "Math", "SSC/Equivalent", "SSCPass", "HSCPass"), array("4", "5", "5", "5", "5", "4.5", "2013", "2015"), 'GeneralSci');
	}*/
	else {
		$result['success'] = false;
		$result['message'] = "Data didn't pass";	
	}
} catch (Exception $ex) {
	$result['success'] = false;
	$result['message'] = $ex->getMessage();
}

echo json_encode($result);
die();
?>