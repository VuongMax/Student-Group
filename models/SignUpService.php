<?php
require_once 'config/AutoLoad.php';

class SignUpService {

	private $name;
	private $email;
	// private $id;
	// private $class;
	private $passwd;
	private $confimPass;
	private $checked;

	public function __construct($name, $email,
								$passwd, $confimPass) {
		$this->name = $name;
		$this->email = $email;
		// $this->id = $id;
		// $this->class = $class;
		$this->passwd = $passwd;
		$this->confimPass = $confimPass;
		$this->checked = false;
	}

	public function getName() {
		return $this->name;
	}
	public function getEmail() {
		return $this->email;
	}
	// public function getID() {
	// 	return $this->id;
	// }
	// public function getClass() {
	// 	return $this->class;
	// }
	public function getPasswd() {
		return $this->passwd;
	}
	public function getConfirmPass() {
		return $this->confimPass;
	}
	public function getChecked() {
		return $this->checked;
	}

	public function validInput() {
		if (empty($this->name)) {
			return 1;
		}
		else if (empty($this->email)) {
			return 2;
		}
		else if ( !Validate::isValidEmail($this->getEmail()) ) {
			$this->email = Validate::sanitizeEmail( $this->getEmail());
			return 3;
		}
		else if (User::isExist($this->getEmail())) {
			return 4;
		}
		// else if (empty($this->id)) {
		// 	return 5;
		// }
		// else if (empty($this->class)) {
		// 	return 6;
		// }
		else if (empty($this->passwd)) {
			return 7;
		}
		else if (empty($this->confirmPass) && 
			($this->getPasswd() != $this->getConfirmPass())) {
			return 8;
		} else {
			$this->checked = true;
			return 0;
		}
	}

	public function signUp() {
		if ($this->getChecked()) {
			$student = new Student( $this->getName(),
								$this->getEmail(),'Student','',
								  '','','','','', date("Y-m-d H:i:s"));

			$student->insertObject();
			$db = new DataDriver();
			$salt = "$2a$10$".substr(sha1(mt_rand()),0,22);
			$passwd = crypt($this->getPasswd(), $salt);
			$db->insert(AUTH, ['email' => $this->getEmail(), 'passwd' => $passwd]);

			return true;
		}

		return false;
	}
}