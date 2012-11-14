<?php
  class Config{

    private static $instance;
    private $configVars = array();

    function getInstance(){
      if(!self::$instance){
        self::$instance = new Config();
      }  
      return self::$instance;
    }

    function get($key){
      return $this->configVars[$key];  
    }
    
    function set($key, $val){
      $this->configVars[$key] = $val;
      return true;
    }

    public $dbHost = 'localhost';
    public $dbUser = 'ronald';
    public $dbPass = 'oofie810';
    public $dbName = 'recipe';
  
  //image
    public $path = 'user_generated_images/original/';
    public $imageFolder = 'user_generated_images/';

  }
?>
