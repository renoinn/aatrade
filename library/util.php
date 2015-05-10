<?php

class Util {

	public static function gsc_2_cost($c, $s = 0, $g = 0) {
		$cost = ($g * 10000) + ($s * 100) + $c;
		error_log('['.__METHOD__.'] cost='.$cost.' / g='.$g.' s='.$s.' c='.$c);
		return $cost;
	}

	public static function cost_2_gsc($cost, $isString = false) {
		$g = floor($cost / 10000);
		$cost -= $g * 10000;
		
		$s = 0;
		if (0 < $cost) {
			$s = floor($cost / 100);
		}

		$c = 0;
		if (0 < $cost) {
			$c = $cost - $s * 100;
		}
		error_log('['.__METHOD__.'] cost='.$cost.' / g='.$g.' s='.$s.' c='.$c);

		if ($isString) {
			$str = '';
			if (0 < $g) $str .= $g.'金';
			if (0 < $s) $str .= $s.'銀';
			if (0 < $c) $str .= $c.'銅';

			return $str;
		}
		return array($g, $s, $c);
	}
}
