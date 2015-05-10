<?php
require_once dirname(__FILE__).'/library/util.php';
require_once dirname(__FILE__).'/library/model.php';

if (isset($_GET['error_code']) && $_GET['error_code'] != '') {
	$error_code = $_GET['error_code'];
}

$values = array(
	'type' => 'buy',
	'closed' => 0,
	'deleted' => 0,
);
$buy_data = Model::get_merchandise($values);

$values['type'] = 'sell';
$sell_data = Model::get_merchandise($values);

require_once './templates/index.html';

