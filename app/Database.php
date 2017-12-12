<?php
namespace JessHilario\Chatear\App;

/**
* Database Core
*/
class Database {
	private $CONNECTION = false;
	private $status = false;
	
	function __construct() {
		global $config;
		$this->CONNECTION = new \mysqli(
			$config->get('db.server', 'localhost'),
			$config->get('db.username', 'root'),
			$config->get('db.password', ''),
			$config->get('db.database', '')
		);

		if($this->CONNECTION->connect_error) {
			die("La coneccion a la base de datos ha fallado: ".$this->CONNECTION->connect_error);
		} else {$this->status = true;}
	}

	private function resultToArray($result) {
		$rows = array();
		while($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function query($sql) {
		$response = new Response();
		$result = $this->CONNECTION->query($sql);
		if( $this->CONNECTION->errno != 0 ) {
			return $this->CONNECTION->error_list;
		}
		if ($result->num_rows > 0) {
			return $this->resultToArray($result);
		}
		return [];
	}

	public function insert($table, $keys, $values) {
		return ($this->CONNECTION->query("INSERT INTO {$table} ({$keys}) VALUES({$values})") === TRUE);
	}

	public function checkError() {
		return ($this->CONNECTION->errno != 0);
	}

	public function getErrors() {
		return $this->CONNECTION->error_list;
	}

	public function close(){
		if($this->status) {
			$this->CONNECTION->close();
			$this->status = false;
		}
	}
}