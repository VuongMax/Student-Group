<?php
require_once 'config/Database.php';
require_once 'DataDriver.php';
require_once 'User.php';

class Student extends User {
	
	private $class;
	private $specialized;
	
	public function __construct($name, $email, $group, $phone, 
			$id, $address, $birthday, $dateCreated, $class, $specialized) {
		parent::__construct($name, $email, $group, $phone, $id, $address, $birthday, $dateCreated);
		$this->class = $class;
		$this->specialized = $specialized;
	}
	
	/**
	 * Method get Class of Student
	 * @return String class of Student
	 */
	public function getClass() {
		return $this->class;
	}
	
	public function setClass( $class) {
		$this->class = $class;
	}

	/**
	 * Method get Specialized of Student
	 * @return String Specialized of Student
	 */
	public function getSpecialized() {
		return $this->specialized;
	}

	public function setSpecialized( $specialized) {
		$this->specialized = $specialized;
	}
	
	public function insertObject() {
		parent::insertObject();
		$connector = new DataDriver();
		return $connector->insert(STUDENT, [ 'class' => $this->getClass(),
									'specialized' => $this->getSpecialized(),
									'email' => $this->getEmail()]);
	}

	public function updateObject() {
		parent::updateObject();
		$connector = new DataDriver();
		return $connector->update(STUDENT, ['class' => $this->getClass(),
									'specialized' => $this->getSpecialized()],
									['email' => $this->getEmail()]);
	}

	public static function getStudent( $email) {
		$user = User::getUser($email);
		if ($user == null) {
			return null;
		} else {
			$connector = new DataDriver();
			$statement = $connector->select(STUDENT, ['*'], array('email' => $email));
			$connector->close();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			return new Student(	$user->getName(),
								$user->getEmail(),
								$user->getGroup(),
								$user->getPhone(),
								$user->getID(),
								$user->getAddress(),
								$user->getBirthday(),
								$user->getDateCreated(),
								$data['class'],
								$data['specialized']);
		}
	}
	
	/**
	 * Ham tra ve mang doi tuong cac lop ma sinh vien dang theo hoc
	 */
	public function getStudyClass() {
		$connector = new DataDriver();
		$statement = $connector->select(STUDY,['classID'], ['email' => $this->getEmail()]);
		$result = array();
		$i = 0;
		while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
			$result[$i++] = StudyClass::getStudyClass($row['classID']);
		}

		$statement = NULL;
		$connector->close();
		return $result;
	}
}