<?php
require_once 'User.php';

class Teacher extends User {
	
	private $department;
	private $level;
	
	public function __construct($name, $email, $group, $phone, $id,
			 $address, $birthday, $dateCreated, $department, $level) {
		
		parent::__construct($name, $email, $group, $phone, 
					$id, $address, $birthday, $dateCreated);
		$this->department = $department;
		$this->level = $level;
	}
	
	/**
	 * Method get Department of Teacher
	 * @return String Department of Teacher
	 */
	public function getDepartment() {
		return $this->department;
	}

	public function setDepartment( $department) {
		$this->department = $department;
	}
	
	/**
	 * Method get Level of Teacher
	 * @return String Level of Teacher
	 */
	public function getLevel() {
		return $this->level;
	}
	
	public function setLevel( $level) {
		$this->level = $level;
	}

	public function insertObject() {
		$connector = new DataDriver();
		parent::insertObject();
		return $connector->insert(TEACHER, 
					[ 'department' => $this->getDepartment(),
					'level' => $this->getLevel(),
					'email' => $this->getEmail()]);
	}

	public function updateObject() {
		$connector = new DataDriver();
		parent::updateObject();
		return $connector->update(TEACHER, 
					['department' => $this->getDepartment(),
					'level' => $this->getLevel()],
					['email' => $this->getEmail()]);
	}

	public static function getTeacher( $email) {
		$user = User::getUser($email);
		if ($user == null) {
			return null;
		} else {
			$connector = new DataDriver();
			$statement = $connector->select(TEACHER, array('*'), 
											array('email' => $email));
			$connector->close();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			return new Teacher(	$user->getName(),
								$user->getEmail(),
								$user->getGroup(),
								$user->getPhone(),
								$user->getID(),
								$user->getAddress(),
								$user->getBirthday(),
								$user->getDateCreated(),
								$data['department'],
								$data['level']);
		}
	}
	
	public function getStudyClass() {
		$connector = new DataDriver();
		$statement = $connector->select(STUDY_CLASS,['classID'], ['emailTeacher' => $this->getEmail()]);
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