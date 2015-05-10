<?php
require_once dirname(__FILE__).'/library/util.php';
require_once dirname(__FILE__).'/library/model.php';

if (isset($_GET['error_code']) && $_GET['error_code'] != '') {
	$error_code = $_GET['error_code'];
}

$id = '';
if(isset($_GET['mid']) && $_GET['mid'] != '') {
	$id = $_GET['mid'];
}
$values = array(
	'mid' => $id,
	'closed' => 0,
	'deleted' => 0,
);
$data = Model::get_merchandise($values);
$merchandise = $data[0];

$values = array(
	'mid' => $id,
	'deleted' => 0,
);
$bid_data = Model::get_bid($values);

require_once './templates/bid.html';


