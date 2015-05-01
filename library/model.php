<?php
require_once dirname(dirname(__FILE__)).'/config.php';
require_once dirname(__FILE__).'/database.php';

class Model {

	public static function add_merchandise($values) {
		$db = Database::instance();
		$keys = array_keys($values);
		$sql = 'INSERT INTO merchandise ('.implode(', ', $keys).') VALUES (:'.implode(', :', $keys).')';

		$id = '';
		$db->start_transaction();
		try {
			$id = $db->execute($sql, $values);
			$db->commit_transaction();
		} catch (DatabaseException $e) {
			error_log($e);
			$db->rollback_transaction();
			return false;
		}
		return $id;
	}

	public static function update_merchandise($values, $mid) {
		$db = Database::instance();
		$keys = array_keys($values);
		$sql = 'UPDATE merchandise SET ';
		for($i = 0; $i < count($keys); $i++) {
			if ($i != 0) $sql .= ', ';
			$sql .= $keys[$i].'=:'.$keys[$i];
		}
		$sql .= ' WHERE mid='.$mid;

		$id = '';
		$db->start_transaction();
		try {
			$id = $db->execute($sql, $values);
			$db->commit_transaction();
		} catch (DatabaseException $e) {
			error_log($e);
			$db->rollback_transaction();
			return false;
		}
		return $id;
	}

	public static function get_merchandise($values, $sort = 'DESC') {
		$db = Database::instance();
		$sql = 'SELECT * FROM merchandise';
		$keys = array_keys($values);
		if (0 < count($keys)) {
			$where = ' WHERE ';
			for($i = 0; $i < count($keys); $i++) {
				if ($i != 0) $where .= ' AND ';
				$where .= $keys[$i].'=:'.$keys[$i];
			}
			$sql .= $where;
		}
		$sql .= ' ORDER BY created '.$sort;

		$data = array();
		try {
			$data = $db->execute($sql, $values);
		} catch (DatabaseException $e) {
		}
		return $data;
	}

	public static function add_bid($values) {
		$db = Database::instance();
		$keys = array_keys($values);
		$sql = 'INSERT INTO bid ('.implode(', ', $keys).') VALUES (:'.implode(', :', $keys).')';

		$id = '';
		$db->start_transaction();
		try {
			$id = $db->execute($sql, $values);
			$db->commit_transaction();
		} catch (DatabaseException $e) {
			error_log($e);
			$db->rollback_transaction();
			return false;
		}
		return $id;
	}

	public static function update_bid($values, $bid) {
		$db = Database::instance();
		$keys = array_keys($values);
		$sql = 'UPDATE bid SET ';
		for($i = 0; $i < count($keys); $i++) {
			if ($i != 0) $sql .= ', ';
			$sql .= $keys[$i].'=:'.$keys[$i];
		}
		$sql .= ' WHERE bid='.$bid;

		$db->start_transaction();
		try {
			$db->execute($sql, $values);
			$db->commit_transaction();
		} catch (DatabaseException $e) {
			error_log($e);
			$db->rollback_transaction();
			return false;
		}
		return $bid;
	}

	public static function get_bid($values, $sort = 'DESC') {
		$db = Database::instance();
		$sql = 'SELECT * FROM bid';
		$keys = array_keys($values);
		if (0 < count($keys)) {
			$where = ' WHERE ';
			for($i = 0; $i < count($keys); $i++) {
				if ($i != 0) $where .= ' AND ';
				$where .= $keys[$i].'=:'.$keys[$i];
			}
			$sql .= $where;
		}
		$sql .= ' ORDER BY created '.$sort;

		$data = array();
		try {
			$data = $db->execute($sql, $values);
		} catch (DatabaseException $e) {
		}
		return $data;
	}
}
