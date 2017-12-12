<?php
namespace JessHilario\Chatear\App;

/**
* Controller Manager
*/
class ControllerManager {
	public $ci;
	
	function __construct() {
		global $ci;
		$this->ci = $ci;
	}				

	public function redirect($uri) {
		header('Location: '.$uri);
	}

	public function params($method = 'ALL', $name=false) {
		$params = $method === 'ALL' ? $_REQUEST : $method === 'GET' ? $_GET : $_POST;
		if(!$name) {
			return $params;
		} else {
			if( array_key_exists($name, $params) ) {
				return $params[$name];
			}
		}
		return 'undefined';
	}

	public function get_params($name=false, $default = false) {
		$p = $this->params('GET', $name);
		if($p==="undefined") {
			return $default;
		}
		return $p;
	}

	public function post_params($name=false, $default = false) {
		$p = $this->params('POST', $name);
		if($p==="undefined") {
			return $default;
		}
		return $p;
	}
}