<?php
require_once 'config/AutoLoad.php';


class SignIn extends Controller {

	public function index() {
		if (isset($_POST['email']) && isset($_POST['password'])) {
			if (isset($_POST['remember'])) {
				AuthService::login($_POST['email'], $_POST['password'], true);
			} else {
				AuthService::login($_POST['email'], $_POST['password'], false);
			}
		}

		if (isset($_SESSION['email']))
			$this->redirect(SERVER.'index.php');
		else
			$this->redirect(SERVER.'index.php/Home/view/2');
	}
}
