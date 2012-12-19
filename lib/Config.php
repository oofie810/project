<?php
  class Config{

    private static $instance;

    function getInstance(){
      if(!self::$instance){
        self::$instance = new Config();
      }  
      return self::$instance;
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
