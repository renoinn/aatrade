<?php

class Error {
	const ERROR_SYSTEM = '0';

	public static $ERROR_MESSAGE = array(
		'0' => 'エラーじゃボケ！',
		'1001' => 'キャラ名入れろ',
		'1002' => 'アイテム名入れろ',
		'1003' => '個数は数字にしろ馬鹿',
		'1004' => '単価は数字だハゲ',
		'1005' => '編集用コードは数字だハゲ',
		'1006' => 'アイテム名入れろ',
		'1007' => 'アイテム名入れろ',
	);

	public static function do_error_response($url, $error_code = 0) {
		if (strpos($url, '?') === false) {
			$url .= '?error_code='.$error_code;
		} else {
			$url .= '&error_code='.$error_code;
		}
		header("HTTP/1.1 500 Internal Server Error");
		header('Location: '.$url);
		exit;
	}
}
