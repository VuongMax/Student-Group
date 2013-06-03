<?php
require_once 'config/Database.php';
require_once 'config/Env.php';
require_once 'DataDriver.php';

class AuthService {


	public static function authenticate($email, $passwd) {
		$db = new DataDriver();
		$stm = $db->select(AUTH, ['passwd'], ['email' => $email]);
		if ($stm->rowCount() <= 0) {
			return false;
		} else {
			$user = $stm->fetch(PDO::FETCH_ASSOC);
			return self::checkPass($passwd, $user['passwd']);
		}
	}

	protected static function checkPass($passwd, $hashPass) {
		return (crypt($passwd, $hashPass) == $hashPass);
	}

	public static function login($email, $passwd, $remember = false) {
		if (self::authenticate($email,$passwd)) {
			$db = new DataDriver();
			$stm = $db->select(USER, ['name','groups'],['email' => $email]);
			$info = $stm->fetch(PDO::FETCH_ASSOC);

			$_SESSION['email'] = $email;
			$_SESSION['group'] = $info['groups'];
			$_SESSION['name'] = $info['name'];
			if ($remember) {
				// setcookie( $name, $value, $expireDate, $path, $domain, $secure, $httponly);
				$cookie = sha1(mt_rand());
				setcookie('__rlg', $cookie,time() + 3600*24*7,
									 '/', 'localhost', false, true);
				$db->update(AUTH, ['relogin' => $cookie], ['email' => $email]);
			}

			return true;
		}

		return false;
	}

	protected static function reLogin( $secret) {
		$db = new DataDriver();
		$stm = $db->select(AUTH, ['email'], ['relogin' => $secret]);
		if ($stm->rowCount() == 1) {
			$info = $stm->fetch(PDO::FETCH_ASSOC);
			$_SESSION['email'] = $info['email'];
			$stm = $db->select(USER,['name','groups'], ['email' => $_SESSION['email']]);
			$info = $stm->fetch(PDO::FETCH_ASSOC);
			$_SESSION['group'] = $info['groups'];
			$_SESSION['name'] = $info['name'];

			$cookie = sha1(mt_rand());
			setcookie('__rlg', $cookie, time() + 3600*24*7,
									'/','localhost', false, true);
			$db->update(AUTH, ['reLogin' => $cookie], ['email' => $_SESSION['email']]);

			return true;
		}

		return false;
	}

	public static function checkAuth() {
		if (isset($_SESSION['email']))
			return true;
		if (isset($_COOKIE['__rlg']))
			return self::reLogin($_COOKIE['__rlg']);

		return false;
	}

}  //End Of class AuthService