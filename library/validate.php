<?php

class ValidationException extends Exception {
	private $error_code = 0;

	/*
	public function __construct($error_code = 9999) {
		$this->error_code = $error_code;
	}
	*/

	public function get_error_code() {
		return $this->error_code;
	}

	public function set_error_code($code) {
		$this->error_code = $code;
	}
}

class Validate {
	public static $error_code;

	public static function check($values) {
		$keys = array_keys($values);

		try {
			foreach($keys as $key) {
				$result = call_user_func('self::check_'.$key, $values[$key]);
			}
		} catch(ValidationException $e) {
			error_log('validation error. '.$e->getMessage());
			self::$error_code = $e->get_error_code();
			return false;
		}
		return true;
	}

	private function check_mid($value) {
		if ($value === '') {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if (!is_numeric($value)) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if ($value < 0) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		return true;
	}

	private function check_type($value) {
		if ($value === '') {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if ($value !== 'buy' && $value !== 'sell') {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		return true;
	}

	private function check_character($value) {
		if ($value === '') {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		return true;
	}

	private function check_item($value) {
		if ($value === '') {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		return true;
	}

	private function check_num($value) {
		if ($value === '') {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if (!is_numeric($value)) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if ($value < 0) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		return true;
	}

	private function check_cost_g($value) {
		if ($value === '') {
			return true;
		}
		if (!is_numeric($value)) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if ($value < 0) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		return true;
	}

	private function check_cost_s($value) {
		if ($value === '') {
			return true;
		}
		if (!is_numeric($value)) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if ($value < 0) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		return true;
	}

	private function check_cost_c($value) {
		if ($value === '') {
			return true;
		}
		if (!is_numeric($value)) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if ($value < 0) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		return true;
	}

	private function check_delete_code($value) {
		if ($value === '') {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if (!is_numeric($value)) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if ($value < 0) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		return true;
	}

	private function check_comment($value) {
		return true;
	}

	private function check_bid($value) {
		if ($value === '') {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if (!is_numeric($value)) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		if ($value < 0) {
			throw new ValidationException(__METHOD__.'('.$value.')');
		}
		return true;
	}

	private function check_delete($value) {
		return true;
	}

	private function check_closed($value) {
		return true;
	}
}
