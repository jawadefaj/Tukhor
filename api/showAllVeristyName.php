<?
require_once __DIR__."/../class/VersityFinder.php";

$result = array(
	'success' => true,
	'message' => '',
	'versities' => []
);

$versityFinder = new VersityFinder();

try {
	$result['versities'] = $versityFinder->showAllVersityName();
} catch (Exception $ex) {
	$result['success'] = false;
	$result['message'] = $ex->getMessage();
}

echo json_encode($result);
die();
