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

$result = null;
if ($delete_code == $merchandise[0]['delete_code']) {
	$values = array(
		'updated' => date('Y-m-d H:i:s'),
		'deleted' => 1,
	);
	$result = Model::update_merchandise($values, $mid);
}

if (!$result) {
	error_log('faild add.');
	Error::do_error_response('/aatrade/bid.php?mid='.$params['mid']);
}
header("Content-Type: application/json; charset=utf-8");
header('Location: /aatrade/index.php?success='.$result);
