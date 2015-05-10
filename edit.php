<?php
require_once dirname(__FILE__).'/library/util.php';
require_once dirname(__FILE__).'/library/model.php';

$id = '';
if(isset($_GET['mid']) && $_GET['mid'] != '') {
	$id = $_GET['mid'];
}
$values = array(
	'mid' => $id,
	'closed' => 0,
	'deleted' => 0,
);
$tmp = Model::get_merchandise($values);
$data = $tmp[0];
list($g, $s, $c) = Util::cost_2_gsc($data['cost']);
$data['cost_g'] = $g;
$data['cost_s'] = $s;
$data['cost_c'] = $c;

require_once './templates/edit.html';
