<?php
class Validate {

	public static function sanitizeEmail( $email) {
		return filter_var($email, FILTER_SANITIZE_EMAIL);
	}

	public static function isValidEmail( $email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public static function sanitizeURL( $url) {
		return filter_var($url, FILTER_SANITIZE_URL);
	}

	public static function isValidURL( $url) {
		return filter_var($url, FILTER_VALIDATE_URL);
	}

	public static function isValidIP( $ipAdress) {
		return filter_var($ipAdress, FILTER_VALIDATE_IP);
	}
}