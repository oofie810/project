<?php
  class Cache{
    private $mc;
    private static $instance;

    private function __construct(){
      $this->mc = new Memcached();
      $this->mc->addServer("localhost", 11211);
    }

    public function getInstance(){
      if (!self::$instance){
        self::$instance = new Cache();
      }  
      return self::$instance;
    }

    public function get($key){
      return $this->mc->get($key);
    }
    
    public function set($key, $data){
      $this->mc->set($key, $data);  
    }
  
  
  }

?>
