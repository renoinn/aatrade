<?php
require_once dirname(__FILE__).'/library/validate.php';
require_once dirname(__FILE__).'/library/error.php';
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
	} else {
		$params[$param] = '';
	}
}
if (!Validate::check($params)) {
	Error::do_error_response('/aatrade/index.php');
	exit;
}

$values = array(
	'type' => $params['type'],
	'character' => $params['character'],
	'item' => $params['item'],
	'num' => $params['num'],
	'cost' => Util::gsc_2_cost($params['cost_c'], $params['cost_s'], $params['cost_g']),
	'delete_code' => $params['delete_code'],
	'comment' => $params['comment'],
	'updated' => date('Y-m-d H:i:s'),
);
$result = Model::add_merchandise($values);

if (!$result) {
	error_log('faild add.');
	Error::do_error_response('/aatrade/index.php');
}
header("Content-Type: application/json; charset=utf-8");
header('Location: /aatrade/index.php?success='.$result);
