<?php

    class Database{
    //TODO use private for the rest. Use this also
	private $DB_HOST = 'localhost';
	private $DB_USER = 'ronald';
	private $DB_PASS = 'oofie810';
	private $DB_NAME ='project';
	private $dbh;
	private $stmt;

	public function __construct(){
	    $this->connect();
	}
       
        public function connect(){
		$this->dbh = new PDO("mysql:host=$this->DB_HOST; dbname=$this->DB_NAME", $this->DB_USER, $this->DB_PASS);
		$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	public function query($sql, $param){
	    echo "query";
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

	public function getData(){
	    echo "fetch";
	    return $this->stmt->fetch(PDO::FETCH_ASSOC);    
	    
	}

	public function insert($sql, $param){
	    echo 'insert';
	    $temp = array();
	    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
	    $this->stmt = $this->dbh->prepare($sql);

	    //bind parameters
	    if(sizeof($param) > 0){
		foreach ($param as $key=> $value){
		    $temp[$key] = $value;
		    $this->stmt->bindParam($key, $temp[$key], PDO::PARAM_STR);
		}	
	    }
	    //execute the query 
	    $this->stmt->execute();
	    $last = $this->dbh->lastInsertId();	
	    return $last;
	}	
}

?>
