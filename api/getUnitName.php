<?
require_once __DIR__."/../class/DataHandler.php";

$result = array(
	'success' => true,
	'message' => '',
	'units' => []
);

$handler = new DataHandler();

if(isset($_POST['versity'])) {
	try {
		$result['units'] = $handler->getUnitName($_POST['versity']);
	} catch (Exception $ex) {
		$result['success'] = false;
		$result['message'] = $ex->getMessage();
	}
}

echo json_encode($result);
die();
