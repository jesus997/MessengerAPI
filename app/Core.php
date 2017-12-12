<?php
namespace JessHilario\Chatear\App;

use PHLAK\Config\Config;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use JessHilario\Chatear\Config\Routes;

/**
* Chatear Core
*/
class Core {

	function __construct() {
		global $config, $router, $db;
		$config = new Config(__DIR__.'/../config/config.json');
		$router = new RouteCollector();
		$routes = new Routes();
		$routes->resolve($router);
		$db = new Database();
	}

	function start() {
		global $router, $db;
		$dispatcher = new Dispatcher($router->getData());

		try {
			$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		} catch (HttpRouteNotFoundException $e) {
			$response = $dispatcher->dispatch("GET", "404.html");
		} catch (HttpMethodNotAllowedException $e) {
			$response = $dispatcher->dispatch("GET", "404.html");
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}

		if( is_a($response, 'JessHilario\Chatear\App\Response') ) {
			$response->print();
		} else {
			if(is_array($response) || is_object($response)) {
				print_r($response);
			} else {
				echo $response;
			}
		}

		$db->close();
	} 
}