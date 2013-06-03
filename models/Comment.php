<?php
require_once '../systems/core/DatabaseMethod.php';
require_once '../config/Database.php';
require_once 'DataDriver.php';

class Comment implements DatabaseMethod {
	private $commentID;
	private $commentContent;
	private $commentDate;
	private $topicID;
	private $email;
	
	public function __construct($commentID, $commentContent,
								$commentDate, $topicID, $email) {

		$this->commentID      = $commentID;
		$this->commentContent = $commentContent;
		$this->commentDate    = $commentDate;
		$this->topicID        = $topicID;
		$this->email          = $email;
	}

	public function getCommentID() {
		return $this->commentID;
	}

	public function getCommentContent() {
		return $this->commentContent;
	}

	public function setCommentContent( $content) {
		$this->commentContent = $content;
	}

	public function getCommentDate() {
		return $this->commentDate;
	}

	public function setCommentDate( $date) {
		$this->commentDate = $date;
	}

	public function getTopicID() {
		return $this->topicID;
	}

	public function getEmail() {
		return $this->email;
	}
	
	public static function getComment( $commentID) {
		$connector = new DataDriver();
		$statement = $connector->select(COMMENT, ['*'],
						array('commentID' => $commentID));
		$data = $statement->fetch(PDO::FETCH_ASSOC);
		$statement = NULL;
		$connector->close();
		return new Comment($data['commentID'],
						   $data['commentContent'],
						   $data['commentDate'],
						   $data['topicID'],
						   $data['email']);
	}

	public function insertObject() {
		$connector = new DataDriver();
		return $connector->insert(COMMENT, array(
										'commentID'      => $this->getCommentID(),
										'commentContent' => $this->getCommentContent(),
										'commentDate'    => $this->getCommentDate(),
										'topicID'        => $this->getTopicID(),
										'email'          => $this->getEmail()
									));
	}

	public function updateObject() {
		$connector = new DataDriver();
		return $connector->update(COMMENT,
								[ 'commentID' => $this->getCommentID(),
								'commentContent' => $this->getCommentContent(),
								'commentDate' => $this->getCommentDate(),
								'topicID' => $this->getTopicID(),
								'email' => $this->getEmail()]);
	}
}