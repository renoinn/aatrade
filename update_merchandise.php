<?php
require_once dirname(__FILE__).'/library/util.php';
require_once dirname(__FILE__).'/library/model.php';

$UPDATE_MERCHANDISE_PARAMS = array(
	'mid',
	'character',
	'num',
	'merch_num',
	'delete_code',
	'comment',
);

$params = array();
foreach($BID_PARAMS as $param) {
	if(isset($_POST[$param]) && $_POST[$param] != '') {
		$params[$param] = $_POST[$param];
	}
}
$values = array(
	'character' => $params['character'],
	'num' => $params['num'],
	'delete_code' => $params['delete_code'],
	'comment' => $params['comment'],
	'updated' => date('Y-m-d H:i:s'),
);
$result = Model::update_merchandise($values, $params['mid']);

/*
$values = array(
	'mid' => $params['mid'],
	'num' => $params['merch_num'] - $params['num'],
);
*/

if (!$result) {
	error_log('faild add.');
	doErrorResponse();
}
header("Content-Type: application/json; charset=utf-8");
header('Location: /aatrade/bid.php?mid='.$params['mid'].'&success='.$result);

function doErrorResponse() {
	header("HTTP/1.1 500 Internal Server Error");
	header('Location: /aatrade/bid.php?mid='.$params['mid']);
	exit;
}
