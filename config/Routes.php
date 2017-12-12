<?php
namespace JessHilario\Chatear\Config;

use Phroute\Phroute\RouteCollector;
use JessHilario\Chatear\App\Response;

/**
* Routes Core
*/
class Routes {

	function resolve(RouteCollector $router) {

		$router->get('404.html', function() {
			$response = new Response([]);
			return $response->error()->message("La ruta solicitada no existe o no esta disponible.")->toJSON();
		});

		$router->group(['prefix' => 'v1'], function($router){
			$router->get('/', function() {
				$response = new Response("Hello world!");
				return $response->toJSON();
			});

			$router->get('/users', ['JessHilario\Chatear\Controller\UserController', 'index']);
			$router->post('/users/create', ['JessHilario\Chatear\Controller\UserController', 'create']);
			$router->get('/user/{id}', ['JessHilario\Chatear\Controller\UserController', 'read']);
			$router->post('/user/{id}/update', ['JessHilario\Chatear\Controller\UserController', 'update']);
			$router->post('/user/{id}/remove', ['JessHilario\Chatear\Controller\UserController', 'delete']);
			$router->get('/auth/check', ['JessHilario\Chatear\Controller\UserController', 'checkAuth']);

			$router->get('/messages', ['JessHilario\Chatear\Controller\MessagesController', 'index']);
			$router->post('/messages/create', ['JessHilario\Chatear\Controller\MessagesController', 'create']);
			$router->get('/message/{id}', ['JessHilario\Chatear\Controller\MessagesController', 'read']);
			$router->post('/message/{id}/update', ['JessHilario\Chatear\Controller\MessagesController', 'update']);
			$router->post('/message/{id}/remove', ['JessHilario\Chatear\Controller\MessagesController', 'delete']);

			$router->get('/users/pdf', ['JessHilario\Chatear\Controller\UserController', 'downloadPDFUsers']);
		});
	}
}