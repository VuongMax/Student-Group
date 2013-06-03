<?php
require_once 'systems/core/DatabaseMethod.php';
require_once 'DataDriver.php';

class User implements DatabaseMethod {
	protected $name;
	protected $email;
	protected $groups;
	protected $phone;
	protected $id;
	protected $address;
	protected $birthday;
	protected $dateCreated;
	
	/**
	 * [__construct description]
	 * @param [type] $name     [description]
	 * @param [type] $email    [description]
	 * @param [type] $password [description]
	 * @param [type] $phone    [description]
	 * @param [type] $id       [description]
	 * @param [type] $address  [description]
	 * @param [type] $birthday [description]
	 */
	function __construct($name, $email, $groups, $phone, 
						$id, $address, $birthday, $dateCreated) {

		$this->name     = $name;
		$this->email    = $email;
		$this->groups 	= $groups;
		$this->phone    = $phone;
		$this->id       = $id;
		$this->address  = $address;
		$this->birthday = $birthday;
		$this->dateCreated = $dateCreated;
	}

	/**
	 * Method get Name of User
	 * @return String Name of User
	 */
	public function getName() {
		return $this->name;
	}

	public function setName( $name) {
		$this->name = $name;
	}

	/**
	 * Method get Email of User
	 * @return String Email of User
	 */
	public function getEmail() {
		return $this->email;
	}

	public final function setEmail( $email) {
		$connector = new DataDriver();
		$connector->update(USER, ['email' => $email],
							['email' => $this->getEmail()]);
		$this->email = $email;
	}

	public function getGroup() {
		return $this->groups;
	}

	public function setGroup($groups) {
		$this->groups = $groups;
	}

	/**
	 * Method get Phone number of User
	 * @return String phone number of User
	 */
	public function getPhone() {
		return $this->phone;
	}

	public function setPhone( $phone) {
		$this->phone = $phone;
	}

	/**
	 * Method get ID of User
	 * @return String ID of User
	 */			
	public function getID() {
		return $this->id;
	}

	public function setID( $id) {
		$this->id = $id;
	}

	/**
	 * Method get Address of User
	 * @return String Address of User
	 */
	public function getAddress() {
		return $this->address;
	}

	public function setAddress( $address) {
		$this->address = $address;
	}

	/**
	 * Method get Birthday of User
	 * @return Date Birthday of User
	 */
	public function getBirthday() {
		return $this->birthday;
	}

	public function setBirthday( $birthday) {
		$this->birthday = $birthday;
	}

	public function getDateCreated() {
		return $this->dateCreated;
	}

	public function insertObject() {
		$connector = new DataDriver();
		return $connector->insert(USER, [  'name' => $this->getName(), 
									'email' => $this->getEmail(), 
									'groups' => $this->getGroup(),
									'phone' => $this->getPhone(), 
									'id' => $this->getID(),
									'address' => $this->getAddress(),
									'birthday' => $this->getBirthday(),
									'dateCreated' => $this->getDateCreated()]);
	}

	public function updateObject() {
		$connector = new DataDriver();
		return $connector->update(USER, ['name' => $this->getName(),
								'groups' => $this->getGroup(),
								'phone' => $this->getPhone(),
								'id' => $this->getID(),
								'address' => $this->getAddress(),
								'birthday' => $this->getBirthday()],
								['email' => $this->getEmail()]);
	}

	/**
	 * Ham kiem tra xem $emai da co trong CSDL hay chua.
	 * @param unknown $email
	 */
	public static function isExist( $email) {
		$connector = new DataDriver();
		return $connector->isExist(USER, ['email' => $email]);
	}

	public static function getUser( $email) {
		$connector = new DataDriver();
		$statement = $connector->select(USER, ['*'], ['email' => $email]);
		$connector->close();
		if ($statement->rowCount() <= 0) {
			return NULL;
		} else {
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			return new User($data['name'], $data['email'], 
							$data['groups'], $data['phone'], 
							$data['id'], $data['address'], 
							$data['birthday'], $data['dateCreated']);
		}
	}
	
}