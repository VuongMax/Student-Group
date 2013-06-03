<?php
require_once 'config/AutoLoad.php';
require_once 'config/Env.php';

class PasswdService {
	private $email;
	private $passwd;
	private $newPasswd;
	private $confirm;
	private $valid;

	public function __construct($email, $passwd, $newPasswd, $confirm) {
		$this->email = $email;
		$this->passwd = $passwd;
		$this->newPasswd = $newPasswd;
		$this->confirm = $confirm;
		$this->valid = false;
	}

	public function getEmail() {
		return $this->email;
	}
	public function getPasswd() {
		return $this->passwd;
	}
	public function getNewPasswd() {
		return $this->newPasswd;
	}
	public function getConfirm() {
		return $this->confirm;
	}


	public function check() {
		if (!AuthService::authenticate(
				$this->getEmail(), $this->getPasswd()))
			return 1;

		if ($this->getNewPasswd() != $this->getConfirm())
			return 2;

		$this->valid = true;
		return 0;
	}

	public function update() {
		if ($this->valid) {
			$db = new DataDriver();
			$salt = "$2a$10$".substr(sha1(mt_rand()),0,22);
			$passwd = crypt($this->getNewPasswd(), $salt);
			return $db->update(AUTH, ['passwd' => $passwd],
									['email' => $this->getEmail()]);
		}
		return false;
	}
}