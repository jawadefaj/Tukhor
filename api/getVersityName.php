<?
require_once __DIR__."/../class/DataHandler.php";

$result = array(
	'success' => true,
	'message' => '',
	'versities' => []
);

$handler = new DataHandler();

try {
	$result['versities'] = $handler->getVersityName();
} catch (Exception $ex) {
	$result['success'] = false;
	$result['message'] = $ex->getMessage();
}

echo json_encode($result);
die();
