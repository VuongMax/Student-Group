<?php
require_once 'config/Database.php';

class DataDriver {
	protected $driver;
	protected $host;
	protected $user;
	protected $password;
	protected $database;
	protected $connection;
	
	/**
	 * [__construct description]
	 * @param [type] $driver   [description]
	 * @param [type] $host     [description]
	 * @param [type] $user     [description]
	 * @param [type] $password [description]
	 * @param [type] $database [description]
	 */
	public function __construct($driver = DRIVER, $host = DB_SERVER,
			$user = DB_USER, $password = DB_PASSWORD, $database = DB_NAME) {

			$this->driver = $driver;
			$this->host = $host;
			$this->user = $user;
			$this->password = $password;
			$this->database = $database;
	
		try {
			$this->connection = new PDO($this->driver.':host='.$this->host.';
			dbname='.$this->database, $this->user, $this->password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
			echo $e->getTrace();
		}	
	}
	
	public function query( $sql) {
		try {
			$statement = $this->connection->query($sql);
			return $statement;
		} catch (PDOException $e) {
			$e->getMessage();
			$e->getTrace();
		}
	}

	
	/**
	 * Method to INSERT a row into $table
	 * @param  String $table Name of table need insert
	 * @param  Associate array $arrValue  Values of row
	 * @return boolean        True if success, false if fail.
	 */
	public function insert( $table, array $arrValue) {
		$prepareQuery = "INSERT INTO " . $table . " (";
		$pref = "";
		foreach ($arrValue as $key => $value) {
			$prepareQuery .= $pref . $key;
			$pref = ",";
		}
		
		$pref = "";
		$prepareQuery .= ") VALUES (";
		foreach ($arrValue as $key => $value) {
			$prepareQuery .= $pref. ":" . $key;
			$pref = ",";
		}
		$prepareQuery .= ")";
		
		try {
			$STH = $this->connection->prepare($prepareQuery);
			return $STH->execute($arrValue);
		} catch (PDOException $e) {
			echo "ERROR: " . $e->getMessage();
			echo $e->getTrace();
			return false;
		}
	}
	
	/**
	 * [update description]
	 * @param  [type] $table    [description]
	 * @param  array  $arrSet   [description]
	 * @param  array  $arrWhere [description]
	 * @return [type]           [description]
	 */
	public function update( $table,  array $arrSet, array $arrWhere) {
		$prepareQuery = "UPDATE " . $table . " SET ";
		$pref = "";
		
		foreach ($arrSet as $key => $value) {
			$prepareQuery .= $pref . $key . " = :S_" . $key;
			$pref = ", ";
		}
		
		$pref = "";
		$prepareQuery .= " WHERE ";
		foreach ($arrWhere as $key => $value) {
			$prepareQuery .= $pref . $key . " = :W_" . $key;
			$pref = " AND ";
		}
		
		try {
			$statement = $this->connection->prepare($prepareQuery);
			
			// Binds a parameter to the specified variable name
			foreach ($arrSet as $key => $value) {
				$statement->bindParam(':S_'.$key, $arrSet[$key]);
			}
			foreach ($arrWhere as $key => $value) {
				$statement->bindParam(':W_'.$key, $arrWhere[$key]);
			}
			
			return $statement->execute();
		} catch (PDOException $e) {
			echo "ERROR: " . $e->getMessage();
			echo $e->getTrace();
			return false;
		}
	}
	
	/**
	 * [delete description]
	 * @param  [type] $table    [description]
	 * @param  [type] $arrWhere [description]
	 * @return [type]           [description]
	 */
	public function delete( $table, array $arrWhere = NULL) {
		if ($arrWhere == NULL) {
			return $this->connection->query("DELETE FROM $table")->rowCount();
		} else {

			$prepareQuery = "DELETE FROM $table WHERE ";
			$pref = "";
			foreach ($arrWhere as $key => $value) {
				$prepareQuery .= $pref . "$key = :$key";
				$pref = " AND ";
			}
			
			try {
				$statement = $this->connection->prepare($prepareQuery);
				$statement->execute($arrWhere); 
				return $statement->rowCount();
			} catch (PDOException $e) {
				echo "ERROR: " . $e->getMessage();
				echo $e->getTrace();
			}
		}
	}
	
	/**
	 * [select description]
	 * @param  [type] $table    [description]
	 * @param  array  $columns  [description]
	 * @param  [type] $arrWhere [description]
	 * @return [type]           [description]
	 */
	public function select($table, array $columns, array $arrWhere = NULL) {
		$prepareQuery = 'SELECT ';
		$pref = '';
		foreach ($columns as $col) {
			$prepareQuery .= $pref . $col;
			$pref = ', ';
		}

		try {
			
			if ($arrWhere == NULL) {
				$prepareQuery .= " FROM $table";
				return $this->connection->query($prepareQuery);
				
			} else {
				$prepareQuery .= " FROM $table WHERE ";
				$pref = '';
				foreach ($arrWhere as $key => $value) {
					$prepareQuery .= $pref . "$key = :$key";
					$pref = " AND ";
				}
				
				$statement = $this->connection->prepare($prepareQuery);
				$statement->execute($arrWhere);
				return $statement;
			}
		} catch (PDOException $e) {
			echo "ERROR: " . $e->getMessage();
			echo $e->getTrace();
			return false;
		}
	}
	
	/**
	 * Method to check is exist row in table
	 * @param  String  $table    table, which to check
	 * @param  Associate array  $arrWhere conditions to check
	 * @return boolean           True if exist row, False if NOT exist.
	 */
	public function isExist($table, array $arrWhere) {
		$statement = $this->select($table, array('*'), $arrWhere);
		if ($statement->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function close() {
		if ($this->connection != NULL) {
			$this->connection = NULL;
		}
	}
	
	/**
	 * [connect description]
	 * @param  [type] $host     [description]
	 * @param  [type] $user     [description]
	 * @param  [type] $password [description]
	 * @param  [type] $database [description]
	 * @return [type]           [description]
	 */
	public static function connect($host, $user, $password, $database) {
		try {
			$connection = new PDO($this->driver.':host='.$host.';
			dbname='.$database, $user, $password);
			$connection->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
			return  $connection;
		} catch (PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
			echo $e->getTrace();
		}
	}
}