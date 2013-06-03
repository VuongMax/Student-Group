<?php
require_once '../systems/core/DatabaseMethod.php';
require_once 'DataDriver.php';
require_once '../config/Database.php';
require_once 'Comment.php';

class Topic implements DatabaseMethod {
	private $topicID;
	private $topicSubject;
	private $topicDate;
	private $classID;
	private $email;
	
	public function __construct($topicID, $topicSubject,
						$topicDate, $classID, $emailUser) {
		
		$this->topicID      = $topicID;
		$this->topicSubject = $topicSubject;
		$this->topicDate    = $topicDate;
		$this->classID      = $classID;
		$this->email        = $emailUser;
	}

	public function getTopicID() {
		return $this->topicID;
	}

	public function getTopicSubject() {
		return $this->topicSubject;
	}

	public function setTopicSubject( $subject) {
		$this->topicSubject = $subject;
	}

	public function getTopicDate() {
		return $this->topicDate;
	}

	public function setTopicDate( $date) {
		$this->topicDate = $date;
	}

	public function getClassID() {
		return $this->classID;
	}

	public function getEmail() {
		return $this->email;
	}

	public static function getTopic( $topicID) {
		$connector = new DataDriver();
		$statement = $connector->select(TOPIC, ['*'], array('topicID' => $topicID));
		$data = $statement->fetch(PDO::FETCH_ASSOC);
		$statement = NULL;
		$connector->close();

		return new Topic($data['topicID'],
						$data['topicSubject'],
						$data['topicDate'], 
						$data['classID'], 
						$data['email']);
	}

	/**tim hieu typeHint trong pHP
	 * Method to add a topic in Database
	 * @return boolean        true if success, false if fail. 
	 */
	public function insertObject() {
		$connector = new DataDriver();
		return $connector->insert(TOPIC, array(
									'topicID' => $this->getTopicID(),
									'topicSubject' => $this->getTopicSubject(),
									'topicDate' => $this->getTopicDate(),
									'classID' => $this->getClassID(),
									'email' => $this->getEmail()));
	}

	public function updateObject() {
		$connector =  new DataDriver();
		return $connector->update(TOPIC, ['topicID' => $this->getTopicID(),
										'topicSubject' => $this->getTopicSubject(),
										'topicDate' => $this->topicDate(),
										'classID' => $this->getClassID(),
										'email' => $this->getEmail()]);
	}

	public function getComments() {
		$connector = new DataDriver();
		$statement = $connector->select(COMMENT, ['*'], 
										['topicID' => $this->getTopicID()]);
		$result = array();
		$i = 0;
		while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
			$result[$i++] = new Comment($row['commentID'], $row['commentContent'],
									$row['commentDate'], $row['topicID'], $row['email']);
		}
		$statement = NULL;
		$connector->close();
		return $result;
	}
}