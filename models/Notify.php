<?php
class Notify {

	private $message;
	private $type;

	public function __construct($message, $type) {
		$this->message = $message;
		$this->type = $type;
	}

	public function display() {
		echo '<div class="Notify">'.$this->type.': '.$this->message. '</div>';
	}
}