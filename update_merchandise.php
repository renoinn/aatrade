<?php
require_once dirname(__FILE__).'/library/validate.php';
require_once dirname(__FILE__).'/library/error.php';
require_once dirname(__FILE__).'/library/util.php';
require_once dirname(__FILE__).'/library/model.php';

$mid = '';
$delete_code = '';
if (isset($_POST['mid']) && $_POST['mid'] !== '')
{
	$mid = $_POST['mid'];
} else {
	Error::do_error_response('/aatrade/index.php');
}
if (isset($_POST['delete_code']) && $_POST['delete_code'] !== '')
{
	$delete_code = $_POST['delete_code'];
} else {
	Error::do_error_response('/aatrade/edit.php?mid='.$mid);
}

$merchandise = Model::get_merchandise(array('mid' => $mid));
if ($merchandise[0]['delete_code'] != $delete_code)
{
	Error::do_error_response('/aatrade/edit.php?mid='.$mid);
}

$UPDATE_MERCHANDISE_PARAMS = array(
	'character',
	'item',
	'num',
	'cost_g',
	'cost_s',
	'cost_c',
	'comment',
);

$params = array();
foreach($UPDATE_MERCHANDISE_PARAMS as $param) {
	if(isset($_POST[$param]) && $_POST[$param] != '') {
		$params[$param] = $_POST[$param];
	} else {
		$params[$param] = '';
	}
}

if (!Validate::check($params)) {
	Error::do_error_response('/aatrade/edit.php?mid='.$mid, $check->error_code);
	exit;
}

$values = array(
	'character' => $params['character'],
	'item' => $params['item'],
	'num' => $params['num'],
	'cost' => Util::gsc_2_cost($params['cost_c'], $params['cost_s'], $params['cost_g']),
	'comment' => $params['comment'],
	'updated' => date('Y-m-d H:i:s'),
);
$result = Model::update_merchandise($values, $mid);

if (!$result) {
	Error::do_error_response('/aatrade/edit.php?mid='.$mid);
}
header("Content-Type: application/json; charset=utf-8");
header('Location: /aatrade/bid.php?mid='.$mid.'&success='.$result);
