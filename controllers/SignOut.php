<?php
require_once 'config/AutoLoad.php';

class SignOut extends Controller {
	
	public function index() {
		if (isset($_SESSION['email'])) {
			unset($_SESSION['email']);
			unset($_SESSION['group']);
			unset($_SESSION['name']);

			setcookie('__cmt', $cookie,time() - 3600,
									 '/', 'localhost', false, true);

			if (isset($_COOKIE['__rlg'])) {
				$db = new DataDriver();
				$db->update(AUTH,['relogin' => ''], 
					['relogin' => $_COOKIE['__rlg']]);

				setcookie('__rlg', $cookie,time() - 3600,
									 '/', 'localhost', false, true);
			}
		}

		$this->redirect(SERVER);
	}
}
