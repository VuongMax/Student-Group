<?php
require_once 'config/AutoLoad.php';

class Router {

	private $controller = 'Home';
	private $action = 'index';
	private $param = array();

	public function __construct( $request = '') {

		if (!empty($request) && $request != '/') {

			$info = explode('/', trim($request, '/'));
			$size = count($info);
			if ($size >= 1) {
				$this->setController($info[0]);
			}

			if ($size >= 2) {
				$this->setAction($info[1]);
			}

			$reflect = new ReflectionMethod($this->controller, $this->action);
			$numberParam = $reflect->getNumberOfParameters();
			$this->param = array_slice($info, 2, $numberParam);
		}
	}

	protected function setController( $controller) {
		if (class_exists($controller)) {
			$this->controller = $controller;
		} else {
			$this->action = 'error';
		}
		return $this;
	}

	protected function setAction( $action) {
		if (method_exists($this->controller, $action)) {
			$this->action = $action;
		} else {
			$this->action = 'error';
		}
		return $this;
	}

	public function dispatch() {
		$control = $this->controller;
		$method = $this->action;
		$parameters = $this->param;

		$instance = new $control();
		// call_user_method_array($method, $instance, $parameters);
		call_user_func_array([$instance, $method], $parameters);
	}
}