<?php
  require_once('Config.php');
  
  class Database{
    private $dbh;
    private $stmt;
    private static $instance;
    private static $log_queries = true;

    private function __construct(){
      $this->connect();
    }
 
    private function connect(){
      $config = Config::getInstance();
      $this->dbh = new PDO("mysql:host=$config->dbHost; dbname=$config->dbName", $config->dbUser, $config->dbPass);
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  
    private static function getInstance(){
      if (!self::$instance){
        self::$instance = new Database();
      }
      return self::$instance;
    }

    private function query($sql, $params){
      if (self::$log_queries){
        error_log('**************');
        error_log($sql);
        error_log(var_export($params, true));
        error_log('**************');
      }

      try{
        $temp = array();
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->stmt = $this->dbh->prepare($sql);

        //bind parameters
        if (sizeof($params) > 0){
          //assumption is any name parameters do not have 
          //the named parameter 0
          if (array_key_exists(0, $params)){
            // bindvalue is 1-indexed, so $k+1
            foreach ($params as $k => $value){
            $this->stmt->bindValue(($k+1), $value);
            }
          } else{
              foreach ($params as $key=> $value){
                $temp[$key] = $value;
                $this->stmt->bindParam($key, $temp[$key], PDO::PARAM_STR);
              }
        }
      }
      $this->stmt->execute();
    } catch (PDOException $exception_object){
              error_log(var_export($exception_object, true));	
    }
  }

    public static function getRow($sql, $params){
      $db = Database::getInstance();
      $db-> query($sql, $params);
      return $db->stmt->fetch(PDO::FETCH_ASSOC);    
    }

    public static function getMultipleRows($sql, $params){
      $db = Database::getInstance();
      $db-> query ($sql, $params);
      return $db->stmt->fetchAll(PDO::FETCH_ASSOC);    
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
      $db -> query($sql, $params);
    }	
    
    }
?>
