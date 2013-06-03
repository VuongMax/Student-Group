<?php
require_once 'config/AutoLoad.php';

class ClassOpen extends Controller {

	public function index() {
		if (!AuthService::checkAuth())
			$this->redirect(SERVER.'index.php/Home/view/1');
		else if ($_SESSION['group'] != 'Teacher') {
			$this->loadView('header');
			$this->loadView('no_permission');
			$this->loadView('footer');
		} else {
			$this->loadView('header');
			$this->loadView('teacher/open_class');
			$this->loadView('footer');
		}

	}


	public function doOpen() {
		if (!AuthService::checkAuth()) {
			$this->redirect(SERVER.'index.php/Home/view/1');

		} else 
		if ($_SESSION['group'] == 'Teacher' && 
			isset($_POST['classID']) &&
			isset($_POST['className']) && 
			isset($_POST['courseID']) && 
			isset($_POST['semester']) &&
			isset($_POST['dateFinish']) 	) {

			$studyClass = new StudyClass($_POST['classID'], $_POST['className'],
									$_POST['courseID'], $_POST['semester'],
									date('Y-m-d'), $_POST['dateFinish'], $_SESSION['email']);
			$studyClass->insertObject();
		}

		$this->redirect(SERVER.'index.php');
	}

}