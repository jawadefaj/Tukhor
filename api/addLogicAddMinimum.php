<?
require_once __DIR__."/../class/VersityRequirementAdmin.php";

$result = array(
	'success' => true,
	'message' => ''
);

$admin = new VersityRequirementAdmin();

try {
	if (isset($_POST['versity']) && isset($_POST['unit']) && isset($_POST['background']) && isset($_POST['subjectList']))
	$result['message'] = $admin->addLogicAddMinimum("Dummy Versity", "Dummy Unit", "General", array("Inter", "Matric"), 7.33);
} catch (Exception $ex) {
	$result['success'] = false;
	$result['message'] = $ex->getMessage();
}

echo json_encode($result);
die();
