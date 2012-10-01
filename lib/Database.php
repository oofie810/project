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
		error_log(var_export($exception_object, true));	
	    }
	}

	private function query_array($sql, $params){
	    try{
		$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$this->stmt = $this->dbh->prepare($sql);

		//bind parameters
		if (sizeof($params) > 0){
		    // bindvalue is 1-indexed, so $k+1
		    foreach ($params as $k => $value){
			$this->stmt->bindValue(($k+1), $value);
		    }
		}
		//execute the query
		$this->stmt->execute();
	    }
	    catch (PDOException $exception_object){
		error_log(var_export($exception_object, true));	
	    }
	}

	public static function getData($sql, $params, $query_type='query'){
	    $db = Database::getInstance();
	    if($query_type == 'query'){
		$db-> query($sql, $params);
	    } else if($query_type=='query_array'){
		$db->query_array($sql, $params);	
	    }
	    return $db->stmt->fetch(PDO::FETCH_ASSOC);    
	}

	public static function getAll($sql, $params, $query_type='query'){
	    $db = Database::getInstance();
	    if($query_type== 'query'){
		$db-> query ($sql, $params);
	    } else if($query_type == 'query_array'){
		$db->query_array($sql, $params);	
	    }
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

	public static function bulkInsert($sql, $params){
	    $db = Database::getInstance();

	    $db -> query_array($sql, $params);
	}	
}

?>
