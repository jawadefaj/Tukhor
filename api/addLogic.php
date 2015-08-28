<?
require_once __DIR__."/../class/VersityRequirementAdmin.php";

$result = array(
	'success' => true,
	'message' => ''
);

$admin = new VersityRequirementAdmin();

try {
	if (isset($_POST['logicType'])) {
		switch ($_POST['logicType']) {
			case 'addMinimum':
				if (isset($_POST['versity']) && isset($_POST['unit']) && isset($_POST['background']) && isset($_POST['subjectList']) && isset($_POST['minimumValue'])) {
					if ($admin->addLogicAddMinimum($_POST['versity'], $_POST['unit'], $_POST['background'], $_POST['subjectList'], $_POST['minimumValue'])) {}
					else {
						$result['success'] = false;
						$result['message'] = "Something went wrong!";
					}
				}		
				else {
					$result['success'] = false;
					$result['message'] = "Data didn't pass!";
				}
				break;
			case 'leastSubCount':
				if (isset($_POST['versity']) && isset($_POST['unit']) && isset($_POST['background']) && isset($_POST['subjectList']) && isset($_POST['minimumCount'])) {
					if ($admin->addLogicLeastSubCount($_POST['versity'], $_POST['unit'], $_POST['background'], $_POST['subjectList'], $_POST['minimumCount'])) {}
					else {
						$result['success'] = false;
						$result['message'] = "Something went wrong!";
					}
				}		
				else {
					$result['success'] = false;
					$result['message'] = "Data didn't pass!";
				}
				break;
			case 'leastSubLeastGrade':
				if (isset($_POST['versity']) && isset($_POST['unit']) && isset($_POST['background']) && isset($_POST['subjectList']) && isset($_POST['minimumCount']) && isset($_POST['minimumGrade'])) {
					if ($admin->addLogicLeastSubLeastGrade($_POST['versity'], $_POST['unit'], $_POST['background'], $_POST['subjectList'], $_POST['minimumCount'], $_POST['minimumGrade'])) {}
					else {
						$result['success'] = false;
						$result['message'] = "Something went wrong!";
					}
				}	
				else {
					$result['success'] = false;
					$result['message'] = "Data didn't pass!";
				}
				break;
			case 'maxSubLeastGrade':
				if (isset($_POST['versity']) && isset($_POST['unit']) && isset($_POST['background']) && isset($_POST['subjectList']) && isset($_POST['maxCount']) && isset($_POST['minimumGrade'])) {
					if ($admin->addLogicMaxSubLeastGrade($_POST['versity'], $_POST['unit'], $_POST['background'], $_POST['subjectList'], $_POST['maxCount'], $_POST['minimumGrade'])) {}
					else {
						$result['success'] = false;
						$result['message'] = "Something went wrong!";
					}
				}	
				else {
					$result['success'] = false;
					$result['message'] = "Data didn't pass!";
				}
				break;
			case 'minLogic':
				if (isset($_POST['versity']) && isset($_POST['unit']) && isset($_POST['background']) && isset($_POST['subject']) && isset($_POST['minimumGrade'])) {
					if ($admin->addLogicMinLogic($_POST['versity'], $_POST['unit'], $_POST['background'], $_POST['subject'], $_POST['minimumGrade'])) {}
					else {
						$result['success'] = false;
						$result['message'] = "Something went wrong!";
					}
				}	
				else {
					$result['success'] = false;
					$result['message'] = "Data didn't pass!";
				}
				break;
			default:
				$result['success'] = false;
				$result['message'] = "Logic type undefined";
				break;
		}
	}
	else {
		$result['success'] = false;
		$result['message'] = "Logic type not specified";
	}
} catch (Exception $ex) {
	$result['success'] = false;
	$result['message'] = $ex->getMessage();
}

echo json_encode($result);
die();
