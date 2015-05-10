<?php
require_once dirname(__FILE__).'/library/validate.php';
require_once dirname(__FILE__).'/library/error.php';
require_once dirname(__FILE__).'/library/util.php';
require_once dirname(__FILE__).'/library/model.php';

$UPDATE_BID_PARAMS = array(
	'mid',
	'bid',
	'closed',
	'delete',
	'delete_code',
);

$params = array();
foreach ($UPDATE_BID_PARAMS as $param) {
	if(isset($_POST[$param]) && $_POST[$param] != '') {
		$params[$param] = $_POST[$param];
	} else {
		$params[$param] = '';
	}
}

if (!Validate::check($params)) {
	Error::do_error_response('/aatrade/bid.php?mid='.$params['mid']);
	exit;
}

$result = false;
$merchandise = Model::get_merchandise(array('mid' => $params['mid']));
$bid = Model::get_bid(array('bid' => $params['bid']));
if (isset($params['closed']) && $params['closed'] != '') {
	$stock = $merchandise[0]['num'] - $bid[0]['num'];

	$values = array(
		'num' => $stock,
		'updated' => date('Y-m-d H:i:s'),
	);
	$result = Model::update_merchandise($values, $params['mid']);

	$values = array(
		'updated' => date('Y-m-d H:i:s'),
		'closed' => 1,
	);
	$result = Model::update_bid($values, $params['bid']);

} elseif (isset($params['delete']) && $params['delete'] != '') {
	if ($params['delete_code'] == $bid[0]['delete_code'])
	$values = array(
		'updated' => date('Y-m-d H:i:s'),
		'deleted' => 1,
	);
	$result = Model::update_bid($values, $params['bid']);
}


if (!$result) {
	error_log('faild add.');
	Error::do_error_response('/aatrade/bid.php?mid='.$params['mid']);
}
header("Content-Type: application/json; charset=utf-8");
header('Location: /aatrade/bid.php?mid='.$params['mid'].'&success='.$result);
