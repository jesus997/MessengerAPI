<?php
namespace JessHilario\Chatear\App;

/**
* Response Core
*/
class Response {
	private $res;
	private $type;
	private $status;
	private $status_code;
	private $status_message;
	private $add = false;

	const TEXT_PLAIN = 0;
	const JSON = 1;
	const PROCESSED_OBJECT = 3;

	const STATUS_OK = "ok";
	const STATUS_ERROR = "error";

	function __construct($res="") {
		$this->res = $res;
		$this->type = $this->resolveType($res);
		$this->status = self::STATUS_OK;
		$this->status_code = 200;
		$this->status_message = "";

		return $this;
	}

	function data($data=[]) {
		$this->res = $data;
		return $this;
	}

	function add($obj) {
		if(!$this->add) {
			$tempRes = $this->res;
			$tempObj = $obj;
			$this->res = array($tempRes, $tempObj);
			$this->add = true;
		} else {
			$this->res[] = $obj;
		}
		return $this;
	}

	private function is_JSON($data) {
		json_decode($data);
		return (json_last_error() == JSON_ERROR_NONE);
	}

	private function resolveType($obj) {
		if( is_array($obj) || is_object($obj) ) {
			return self::PROCESSED_OBJECT;
		} else if( $this->is_JSON($obj) ) {
			return self::JSON;
		}
		return self::TEXT_PLAIN;
	}

	function error($code=500) {
		$this->status = self::STATUS_ERROR;
		$this->status_code = $code;
		return $this;
	}

	function ok($code=200) {
		$this->status = self::STATUS_OK;
		$this->status_code = $code;
		return $this;
	}

	function message($str="") {
		$this->status_message = $str;
		return $this;
	}

	/**
	 * To JSON Object
	 */
	function toJSON() {
		$this->type = self::JSON;
		return $this;
	}

	/**
	 * To Text Plain Object
	 */
	function toTP() {
		$this->type = self::TEXT_PLAIN;
		return $this;
	}

	/**
	 * To Processed Object
	 */
	function toPO() {
		$this->type = self::PROCESSED_OBJECT;
		return $this;
	}

	public static function convert_from_latin1_to_utf8_recursively($dat) {
		if (is_string($dat))
			return utf8_encode($dat);
		if (!is_array($dat))
			return $dat;
		$ret = array();   
		foreach ($dat as $i => $d)
			$ret[$i] = self::convert_from_latin1_to_utf8_recursively($d);
		return $ret;
	}

	function getResponse() {
		return [
			"status" => $this->status,
			"code" => $this->status_code,
			"message" => $this->status_message,
			"data" => $this->res,
			"count" => count($this->res)
		];
	}

	function print() {
		switch ($this->type) {
			case self::JSON:
				header('Access-Control-Allow-Origin: *');
				header('Content-Type: application/json');
				echo json_encode($this->convert_from_latin1_to_utf8_recursively($this->getResponse()));
				break;
			case self::PROCESSED_OBJECT:
				echo "<pre>";print_r($this->getResponse());echo "</pre>";
				break;
			default:
				print_r($this->getResponse());
				break;
		}
	}
}