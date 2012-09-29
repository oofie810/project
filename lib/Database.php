<?php

    class Database{
	private $DB_HOST = 'localhost';
	private $DB_USER = 'ronald';
	private $DB_PASS = 'oofie810';
	private $DB_NAME ='project';
	private $dbh;
	private $stmt;
	private static $instance;

	private function __construct(){
	    $this->connect();
	}
       
        private function connect(){
		$this->dbh = new PDO("mysql:host=$this->DB_HOST; dbname=$this->DB_NAME", $this->DB_USER, $this->DB_PASS);
		$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	private static function getInstance(){
	    if (!self::$instance)
		self::$instance = new Database();
	    return self::$instance;
	}
	private function query($sql, $param){
	    try{
		$temp = array();
		$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$this->stmt = $this->dbh->prepare($sql);

		//bind parameters
		if (sizeof($param) > 0){
		    foreach ($param as $key=> $value){
			$temp[$key] = $value;
			$this->stmt->bindParam($key, $temp[$key], PDO::PARAM_STR);
		    }
		}
		//execute the query
		$this->stmt->execute();
	    }
	    catch (PDOException $exception_object){
		var_dump ($exception_object);	
	    }
	}

	public static function getData($sql, $params){
	    $db = Database::getInstance();
	    $db-> query($sql, $params);
	    return $db->stmt->fetch(PDO::FETCH_ASSOC);    
	}

	public static function getAll($sql, $params){
	    $db = Database::getInstance();
	    $db-> query ($sql, $params);
	    return $db->stmt->fetchAll(PDO::FETCH_ASSOC);    
	}

	public static function rowCount($sql, $params){
	    $db = Database::getInstance();
	    $db-> query($sql, $params);
	    return $db->stmt->rowCount();
	}

	public static function update($sql, $params){
	    $db = Database::getInstance();
	    $db -> query($sql, $params);
	}

	public static function insert($sql, $params){
	    $db = Database::getInstance();
	    $db -> query($sql, $params);
	    return $db->dbh->lastInsertId();
	}	
}

?>
