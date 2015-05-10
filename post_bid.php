<?php
require_once dirname(__FILE__).'/library/validate.php';
require_once dirname(__FILE__).'/library/error.php';
require_once dirname(__FILE__).'/library/util.php';
require_once dirname(__FILE__).'/library/model.php';

$BID_PARAMS = array(
	'mid',
	'character',
	'num',
	'delete_code',
	'comment',
);

$params = array();
foreach($BID_PARAMS as $param) {
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
$merchandise = Model::get_merchandise(array('mid' => $params['mid']));
if ($merchandise[0]['num'] < $params['num']) {
	Error::do_error_response('/aatrade/bid.php?mid='.$params['mid']);
	exit;
}

$values = array(
	'mid' => $params['mid'],
	'character' => $params['character'],
	'num' => $params['num'],
	'delete_code' => $params['delete_code'],
	'comment' => $params['comment'],
	'updated' => date('Y-m-d H:i:s'),
);
$result = Model::add_bid($values);

if (!$result) {
	error_log('faild add.');
	Error::do_error_response('/aatrade/bid.php?mid='.$params['mid']);
}
header("Content-Type: application/json; charset=utf-8");
header('Location: /aatrade/bid.php?mid='.$params['mid'].'&success='.$result);
