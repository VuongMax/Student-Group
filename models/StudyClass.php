<?php
require_once 'config/AutoLoad.php';

class StudyClass implements DatabaseMethod {
	
	private $classID;
	private $className;
	private $courseID;
	private $semester;
	private $dateStart;
	private $dateFinish;
	private $emailTeacher;
	
	public function __construct( $classID, $className, $courseID, 
							$semester, $dateStart, $dateFinish, $email) {
		$this->classID = $classID;
		$this->className = $className;
		$this->courseID = $courseID;
		$this->semester = $semester;
		$this->dateStart = $dateStart;
		$this->dateFinish = $dateFinish;
		$this->emailTeacher = $email;
	}
	
	public function getClassID() {
		return $this->classID;
	}
	
	public function getClassName() {
		return $this->className;
	}
	
	public function getCourseID() {
		return $this->courseID;
	}
	
	public function getSemester() {
		return $this->semester;
	}

	public function getDateStart() {
		return $this->dateStart;
	}

	public function getDateFinish() {
		return $this->dateFinish;
	}

	public function getEmail() {
		return $this->emailTeacher;
	}
	
	/**
	 * [getStudyClass description]
	 * @param  [type] $classID [description]
	 * @return [type]          [description]
	 */
	public static function getStudyClass( $classID) {
		$connector = new DataDriver();
		$statement = $connector->select(STUDY_CLASS, ['*'], array(
										'classID' => $classID));
		$data = $statement->fetch(PDO::FETCH_ASSOC);
		$statement = NULL;
		$connector->close();
		
		return new StudyClass($data['classID'], $data['className'],
							$data['courseID'], $data['semester'],
							$data['dateStart'], $data['dateFinish'],
							$data['emailTeacher']);
	}
	
	public function insertObject() {
		$connector = new DataDriver();
		
		$studyClass = array('classID' => $this->getClassID(), 
						'className' => $this->getClassName(),
						'courseID' => $this->getCourseID(),
						'semester' => $this->getSemester(),
						'dateStart' => $this->getDateStart(),
						'dateFinish' => $this->getDateFinish(),
						'emailTeacher' => $this->getEmail());
		return $connector->insert(STUDY_CLASS, $studyClass);
	}

	public function updateObject() {
		$connector = new DataDriver();
		return $connector->update(STUDY_CLASS,
						['classID' => $this->getClassID(),
						'className' => $this->getClassName(),
						'courseID' => $this->getCourseID(),
						'semester' => $this->getSemester(),
						'dateStart' => $this->getDateStart(),
						'dateFinish' => $this->getDateFinish(),
						'emailTeacher' => $this->getEmail()],
						['classID' => $this->getClassID()]);
	}
	/**
	 * Ham tra ve mang cac sinh vien dang theo hoc lop nay
	 */
	public function getStudents() {
		$connector = new DataDriver();
		$statement = $connector->select(STUDY,['email'], 
										['classID' => $this->getClassID()]);
		$result = array();
		$i = 0;
		while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
			$result[$i++] = Student::getStudent($row['email']);
		}

		$statement = NULL;
		$connector->close();
		return $result;
	}

	public function getTopics() {
		$connector = new DataDriver();
		$statement = $connector->select(TOPIC, ['*'], 
										['classID' => $this->getclassID()]);
		$result = array();
		$i = 0;
		while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
			$result[$i++] = new Topic($row['topicID'], $row['topicSubject'],
								$row['topicDate'], $row['classID'], $row['emailUser']);
		}
		$statement = NULL;
		$connector->close();
		return $result;
	}
}