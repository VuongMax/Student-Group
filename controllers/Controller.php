<?php
require_once 'config/Env.php';
require_once 'config/AutoLoad.php';

class Controller {

	public function __construct() {

	}
	
	public function index() {
		echo '<h3>Hello World! This is default action</h3>';
	}
	
	public function loadView($view, $data = NULL) {
		if (is_array($data)) {
			extract($data);
		}
		require_once 'views/' . $view . '.php';
	}

	public function redirect($url) {
		header('Location: '. $url);
		exit();
	}

	public function error() {
		$this->loadView('header');
		$this->loadView('error_page');
		$this->loadView('footer');
	}
}