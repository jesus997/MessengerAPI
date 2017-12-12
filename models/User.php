<?php
namespace JessHilario\Chatear\Model;

use JessHilario\Chatear\App\ModelManager;

/**
* User model
*/
class User extends ModelManager {
	static protected $_table = "users";
	static protected $_id = "id";

	static function createResponse($status=false, $code=1, $message="") {
		return [
			"status" => $status,
			"code" => $code,
			"message" => $message
		];
	}

	static function checkAuth($email=null, $password=null) {
		global $db;
		$table = self::$_table;

		if(!is_null($email) && !is_null($password)) {
			if($email && $password) {
				$saved_password = $db->query("SELECT password FROM {$table} WHERE email='".$email."'");
				if(!empty($saved_password) && array_key_exists('password', $saved_password[0])) {
					if(password_verify($password, $saved_password[0]['password'])) {
						return self::createResponse(true, 4, "Las contrase&ntilde;as coinciden.");
					} else {
						return self::createResponse(false, 3, "La contrase&ntilde;as no coinciden. Intentalo de nuevo.");
					}
				} else {
					return self::createResponse(false, 2, "El usuario especificado no existe.");
				}
			}
		}
		return self::createResponse(false, 1, "Todos los campos son requeridos.");
	}
}