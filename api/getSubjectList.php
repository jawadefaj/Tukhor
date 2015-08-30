<?
require_once __DIR__."/../class/DataHandler.php";

$result = array(
	'success' => true,
	'message' => '',
	'subjectList' => []
);

$handler = new DataHandler();

if(isset($_POST['background'])) {
	try {
		switch ($_POST['background']) {
			case 'All':
				$result['subjectList'] = $handler->getSubjectListAll();
				break;
			case 'General':
				$result['subjectList'] = $handler->getSubjectListGeneral();
				break;
			case 'GeneralSci':
				$result['subjectList'] = $handler->getSubjectListGeneralSci();
				break;
			case 'GeneralCom':
				$result['subjectList'] = $handler->getSubjectListGeneralCom();
				break;
			case 'GeneralArts':
				$result['subjectList'] = $handler->getSubjectListGeneralArts();
				break;
			case 'MadrasaSci':
				$result['subjectList'] = $handler->getSubjectListMadrasaSci();
				break;
			case 'MadrasaGen':
				$result['subjectList'] = $handler->getSubjectListMadrasaGen();
				break;
			case 'English':
				$result['subjectList'] = $handler->getSubjectListEnglish();
				break;
			default:
				$result['success'] = false;
				$result['message'] = "Background not recognized";
				break;
		}
	} catch (Exception $ex) {
		$result['success'] = false;
		$result['message'] = $ex->getMessage();
	}
}

else {
	$result['success'] = false;
	$result['message'] = "Data didn't pass";
}

echo json_encode($result);
die();
