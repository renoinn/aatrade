<?php
require_once dirname(__FILE__).'/library/util.php';
require_once dirname(__FILE__).'/library/model.php';

$MERCHANDISE_PARAMS = array(
	'type',
	'character',
	'item',
	'num',
	'cost_g',
	'cost_s',
	'cost_c',
	'delete_code',
	'comment',
);

$params = array();
foreach($MERCHANDISE_PARAMS as $param) {
	if(isset($_POST[$param]) && $_POST[$param] != '') {
		$params[$param] = $_POST[$param];
	}
}
$values = array(
	'type' => $params['type'],
	'character' => $params['character'],
	'item' => $params['item'],
	'num' => $params['num'],
	'cost' => Util::gsc2Cost($params['cost_c'], $params['cost_s'], $params['cost_g']),
	'delete_code' => $params['delete_code'],
	'comment' => $params['comment'],
	'updated' => date('Y-m-d H:i:s'),
);
$result = Model::add_merchandise($values);

if (!$result) {
	error_log('faild add.');
	doErrorResponse();
}
header("Content-Type: application/json; charset=utf-8");
header('Location: /aatrade/index.php?success='.$result);

function doErrorResponse() {
	header("HTTP/1.1 500 Internal Server Error");
	header('Location: /aatrade/index.php');
	exit;
}
