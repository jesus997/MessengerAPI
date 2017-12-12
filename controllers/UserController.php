<?php
namespace JessHilario\Chatear\Controller;

use JessHilario\Chatear\App\ControllerManager;
use JessHilario\Chatear\App\Response;
use JessHilario\Chatear\Model\User;
use Dompdf\Dompdf;

/**
* User Controller
* CRUD
*/
class UserController extends ControllerManager {

	function index() {
		$response = new Response([]);
		$users = User::all();
		return $response->data($users)->toJSON();
	}

	function create() {
		$response = new Response([]);
		$data = $this->post_params();
		$res = User::create($data);
		if(!$res['status']) {
			return $response->error()->message("No se ha podido crear el usuario.")->data($res['errors'])->toJSON();
		}
		return $response->message("Usuario creado con exito.")->toJSON();
	}

	function read($id) {
		$response = new Response([]);
		$user = User::find($id);
		return $response->data($user)->toJSON();
	}

	function update($id) {
		$response = new Response([]);
		$data = $this->post_params();
		$res = User::update($id, $data);
		return $response->data($res)->toJSON();
	}

	function delete($id) {
		$response = new Response([]);
		$remove = User::update($id, ['elogic'=>1]);
		return $response->data($remove)->toJSON();
	}

	function checkAuth() {
		$response = new Response([]);
		$email = $this->get_params("email", false);
		$password = $this->get_params("password", false);

		$check = User::checkAuth($email, $password);
		if(!$check['status']) {
			return $response->error($check['code'])->message($check['message'])->toJSON();
		}
		$user_data = User::find("SELECT * from users where email='".$email."'");
		$user_data = count($user_data) > 0 ? $user_data[0] : [];
		unset($user_data['password']);
		return $response->ok($check['code'])->message($check['message'])->data($user_data)->toJSON();
	}

	function createTable() {
		$users = User::all();
		$table = '<table class="table table-hover" cellpadding="10">
					<thead class="thead-light">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col">Email</th>
						</tr>
					</thead>
					<tbody>';
		foreach ($users as $key => $user) {
			if($user['elogic'] == 1) continue;
			$table .= '<tr>
							<th scope="row">'.$user['id'].'</th>
							<td>'.$user['name'].'</td>
							<td>'.$user['lastname'].'</td>
							<td>'.$user['email'] .'</td>
						</tr>';
		}
		$table .= '</tbody></table>';
		return $table;
	}

	function downloadPDFUsers() {
		$dompdf = new Dompdf();
		$dompdf->loadHtml($this->createTable());
		$dompdf->render();
		$dompdf->stream('messenger-users.pdf');
	}
}