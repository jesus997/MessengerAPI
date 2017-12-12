<?php
namespace JessHilario\Chatear\Controller;

use JessHilario\Chatear\App\ControllerManager;
use JessHilario\Chatear\App\Response;
use JessHilario\Chatear\Model\User;
use JessHilario\Chatear\Model\Message;

/**
* Messages Controller
* CRUD
*/
class MessagesController extends ControllerManager {

	function index() {
		$response = new Response([]);
		$messages = Message::all();
		$data = [];
		foreach ($messages as $key => $message) {
			$user_id = $message["user_id"];
			unset($message["user_id"]);
			$message['user'] = User::find($user_id);
			$data[] = $message;
		}
		return $response->data($data)->toJSON();
	}

	function create() {
		$response = new Response([]);
		$data = $this->post_params();
		$res = Message::create($data);
		if(!$res) {
			return $response->error()->message("No se ha podido crear el mensaje.")->data(Message::get_last_errors())->toJSON();
		}
		return $response->message("Mensaje creado con exito.")->toJSON();
	}

	function read($id) {
		$response = new Response([]);
		$message = Message::find($id);
		return $response->data($message)->toJSON();
	}

	function update($id) {
		$response = new Response([]);
		$data = $this->post_params();
		$res = Message::update($id, $data);
		return $response->data($res)->toJSON();
	}

	function delete($id) {
		$response = new Response([]);
		$remove = Message::remove($id);
		if(!$remove) {
			return $response->error()->message("No se ha podido eliminar el mensaje.")->data(Message::get_last_errors())->toJSON();
		}
		return $response->message("Mensaje eliminado con exito.")->toJSON();
	}
}