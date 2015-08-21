<?php
$saved = json_decode(file_get_contents('data/currentCodes.json'), TRUE);
$currentCodes = $saved['currentCodes'];

$newCodes = json_decode(get('codes'), TRUE);
if( is_array( $newCodes ) && $newCodes ) {
	$len = count($newCodes);
	$mergedCodes = array_merge($currentCodes, $newCodes);
	$complete = count($mergedCodes);
	copy('data/currentCodes.json', 'data/backup/currentCodes-' . date('Y-m-d-H-i-s') . '.json');
	file_put_contents('data/currentCodes.json', json_encode(array('currentCodes'=>$mergedCodes), JSON_PRETTY_PRINT));

	echo json_encode(array(
		'error'=> FALSE,
		'message' => "Updated $len items",
		'counts' => array(
			'new' => $len,
			'current' => $complete,
		),
		'items' => $newCodes,
	));
}
else {
	echo json_encode(array(
		'error'=> TRUE,
		'message' => 'no data',
	));
}




function get($name, $default=NULL) {
	if(isset($_POST[$name]))
		return $_POST[$name];
	return $default;
}