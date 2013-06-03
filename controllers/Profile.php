<?php
require_once 'config/AutoLoad.php';

class Profile extends Controller {


	public function show($case = 0) {
		if (!AuthService::checkAuth())
			$this->redirect(SERVER.'index.php/Home/view/1');

		else if ($_SESSION['group'] == 'Student') {
			$user = Student::getStudent($_SESSION['email']);
			$data['class'] = $user->getClass();
			$data['specialized'] = $user->getSpecialized();

		} else if ($_SESSION['group'] == 'Teacher') {
			$user = Teacher::getTeacher($_SESSION['email']);
			$data['department'] = $user->getDepartment();
			$data['level'] = $user->getLevel();
		}

		$data['name'] = $user->getName();
		$data['email'] = $user->getEmail(); 
		$data['group'] = $user->getGroup();
		$data['phone'] = $user->getPhone();
		$data['id'] = $user->getID();
		$data['address'] = $user->getAddress();
		$data['birthday'] = $user->getBirthday();
		$data['dateCreated'] = $user->getDateCreated();

		if ($case == 1) {
			$this->loadView('header');
			$this->loadView('profile_form',$data);
			$this->loadView('footer');
		} else if ($case == 2) {
			$data['message'] = 'Cap nhat thanh cong!';
			$this->loadView('header');
			$this->loadView('profile',$data);
			$this->loadView('footer');
		} else {
			$this->loadView('header');
			$this->loadView('profile',$data);
			$this->loadView('footer');
		}
		
	}

	public function update() {
		if (!AuthService::checkAuth()) {
			$this->redirect(SERVER.'index.php/Home/view/1');
		} else {

			if ($_SESSION['group'] == 'Teacher') {
				$user = Teacher::getTeacher($_SESSION['email']);
				if (isset($_POST['department']))
					$user->setDepartment($_POST['department']);
				if (isset($_POST['level']))
					$user->setLevel($_POST['level']);

			} else if ($_SESSION['group'] == 'Student') {
				$user = Student::getStudent($_SESSION['email']);
				if (isset($_POST['class']))
					$user->setClass($_POST['class']);
				if (isset($_POST['specialized']))
					$user->setSpecialized($_POST['specialized']);
			}

			if (isset($_POST['name']))
				$user->setName($_POST['name']);
			if (isset($_POST['email']) && Validate::isValidEmail($_POST['email']))
				$user->setEmail($_POST['email']);
			if (isset($_POST['id']))
				$user->setID($_POST['id']);
			if (isset($_POST['phone']))
				$user->setPhone($_POST['phone']);
			if (isset($_POST['address']))
				$user->setAddress($_POST['address']);
			if (isset($_POST['birthday']))
				$user->setBirthday($_POST['birthday']);

			if ($user->updateObject()) {
				$_SESSION['name'] = $user->getName();
				$_SESSION['email'] = $user->getEmail();
			}
			
			$this->redirect(SERVER.'index.php/Profile/show/2');
		}
	}

	public function passForm($notify = 0) {
		if (!AuthService::checkAuth()) {
			$this->redirect(SERVER.'index.php/Home/view/1');
		} else {
			$arrState = ['0' => NULL,
						'1' => new Notify('Password is Incorrect!','Error'),
						'2' => new Notify('New password and Confirm NOT match!','Error')];
			if ($notify >= 0 && $notify <= 2) {
				$data['error'] = $arrState[$notify];
			}

			$this->loadView('header');
			$this->loadView('passwd_form',$data);
			$this->loadView('footer');
		}
	}

	public function doPass() {
		if (!AuthService::checkAuth()) {
			$this->redirect(SERVER.'index.php/Home/view/1');
		} else if (isset($_POST['passwd']) && isset($_POST['newPasswd'])
					&& isset($_POST['confirm'])) {

			$pass = new PasswdService($_SESSION['email'], $_POST['passwd'],
									$_POST['newPasswd'], $_POST['confirm']);

			$notify = $pass->check();
			if ($pass->update()) {
				$this->loadView('header');
				$this->loadView('passwd_update');
				$this->loadView('footer');
			} else { 
				$this->redirect(SERVER.'index.php/Profile/passForm/'.$notify);
			}
		}
	}


}