<?php
require_once 'config/Env.php';
require_once 'config/AutoLoad.php';

class SignUp extends Controller {

	public function index() {
		if (isset($_POST['name']) && isset($_POST['email']) &&
			isset($_POST['password']) && isset($_POST['confirm'])) {

			$service = new SignUpService($_POST['name'],$_POST['email'],
								$_POST['password'], $_POST['confirm']);

			$notify = $service->validInput();
			if ($service->signUp()) {
				$this->redirect(SERVER.'index.php/Home/view/1');
			} else {
				$data = ['name' => $_POST['name'],
						 'email' => $_POST['email'],
						 'password' => $_POST['password']];
				$this->view($notify, $data);
			}
		} else {
			$this->redirect(SERVER.'index.php');
		}
	}
	
	public function view($param = 0, $data = NULL) {
		
		switch ($param) {
			case 1:
				unset($data['name']);
				$data['notify'] = new Notify('Please fill your name', 'Error');
				break;
			case 2:
				unset($data['email']);
				$data['notify'] = new Notify('Please fill your Email', 'Error');
				break;
			case 3:
				unset($data['email']);
				$data['notify'] = new Notify('Email is not valid', 'Error');
				break;
			case 4:
				unset($data['email']);
				$data['notify'] = new Notify('Email is Registered! Try Another', 'Error');
				break;
			case 5:
				$data['notify'] = new Notify('Please fill your ID', 'Error');
				break;
			case 6:
				$data['notify'] = new Notify('Please fill your class', 'Error');
				break;
			case 7:
				unset($data['password']);
				$data['notify'] = new Notify('Please fill your password', 'Error');
				break;
			case 8:
				unset($data['password']);
				$data['notify'] = new Notify('Please fill field: \'Password Confirm\' same fileld: \'password\'','Error');
				break;
			
			default:
				$data = NULL;
				break;
		}

		$this->loadView('register',$data);
	}

} // End of SignUP_Controller