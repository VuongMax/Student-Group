<?php
require_once 'config/AutoLoad.php';

class Home extends Controller {

	public function index() {
		if (AuthService::checkAuth()) {

			if ($_SESSION['group'] == 'Student') {
				$student = Student::getStudent($_SESSION['email']);
				$arrClass = $student->getStudyClass();
				$data['arrClass'] = $arrClass;

				$this->loadView('header');
				$this->loadView('student/home',$data);
				$this->loadView('footer');
				
			} else if ($_SESSION['group'] == 'Teacher') {
				$teacher = Teacher::getTeacher($_SESSION['email']);
				$arrClass = $teacher->getStudyClass();
				$data['arrClass'] = $arrClass;

				$this->loadView('header');
				$this->loadView('teacher/home',$data);
				$this->loadView('footer');
			}

		} else {
			$this->loadView('header');
			$this->loadView('signin_page');
			$this->loadView('footer');
		}
	}

	public function view($notify = 0) {
		$arr = array (
			'0' => NULL,
			'1' => new Notify('You need sign in to Access', 'Notice'),
			'2' => new Notify('Password or Email NOT match!', 'Notice')
			);
		$data['notify'] = NULL;
		if ($notify >= 0 && $notify <=2)
			$data['notify'] = $arr[$notify];
		$this->loadView('header');
		$this->loadView('signin_page', $data);
		$this->loadView('footer');
	}

}