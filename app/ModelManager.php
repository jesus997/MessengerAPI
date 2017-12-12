<?php
namespace JessHilario\Chatear\App;

/**
* Model Core
*/
class ModelManager {

	/* Nombre de la tabla en SQL */
	static protected $_table = "";
	static protected $_id = "id";

	static function all($limit=false) {
		global $db;
		$table = static::$_table;
		$res = $db->query("SELECT * FROM {$table}");
		if(is_numeric($limit) && $limit < count($res)) {
			$res = array_slice($res, 0, $limit, true);
		}
		return $res;
	}

	static function find($id=null) {
		global $db;
		$res = [];
		$table = static::$_table;
		$field_id = static::$_id;
		if(!is_null($id)) {
			if(is_numeric($id)) {
				$res = $db->query("SELECT * FROM {$table} WHERE {$field_id}={$id}");
			} else if(is_string($id)) {
				$res = $db->query($id);
			}
		}
		return $res;
	}

	static function create($data=false) {
		global $db;
		$table = static::$_table;
		$field_id = static::$_id;

		$data['timestep'] = date("Y-m-d H:i:s");

		if($data) {
			$keys = "";
			$values = "";

			foreach ($data as $key => $value) {

				if($key === "password") {
					$value = password_hash($value, PASSWORD_DEFAULT);
				}

				$keys .= $key.",";
				$values .= "'".$value."', ";
			}

			$keys = rtrim($keys,", ");
			$values = rtrim($values,", ");

			return [
				"status" => $db->insert($table, $keys, $values),
				"errors" => $db->getErrors(),
				"data" => $data
			];
		}
		return [
			"status" => false,
			"errors" => [
				"No se ha ingresado información valida"
			],
			"data" => $data
		];
	}

	static function update($id=null, $data=null) {
		global $db;
		$res = [];
		$table = static::$_table;
		$field_id = static::$_id;
		if(!is_null($id) && !is_null($data)) {
			$values = "";
			foreach ($data as $key => $value) {
				$values .= "{$key}='{$value}', ";
			}
			$values = rtrim($values,", ");
			$res = $db->query("UPDATE {$table} SET {$values} WHERE {$field_id}='{$id}'");
		}
		return $res;
	}

	static function remove($id=null) {
		global $db;
		$table = static::$_table;
		$field_id = static::$_id;
		if(!is_null($id)) {
			$res = $db->query("DELETE FROM {$table} WHERE {$field_id}='{$id}'");

			return ($res === TRUE);
		}
		return false;
	}

	static function get_last_errors() {
		global $db;
		return $db->getErrors();
	}
}