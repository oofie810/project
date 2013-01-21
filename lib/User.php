<?php
  require_once('LogAction.php');
  require_once('Database.php');
  class User{

    private $userId, $username, $password, $email, $privileges;
    private $first_name, $last_name, $date_of_birth, $gender, $status, $profile_pic;
    public function __construct($userId, $username, $password, $email,
				$first_name, $last_name, $dob, $gender, $status, $profile_pic, $privileges){
	    $this->setUserId($userId);
	    $this->setUsername($username);
	    $this->setPassword($password);
	    $this->setEmail($email);
	    $this->setFirstName($first_name);
	    $this->setLastName($last_name);
	    $this->setBirthDate($dob);
	    $this->setGender($gender);
	    $this->setStatus($status);
	    $this->setImage($profile_pic);
      $this->setPrivileges($privileges);
    }
    public function setUserId($id){
        $this->userId= $id;
    }
    public function getUserId(){
        return $this->userId;    
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getUsername(){
        return $this->username;    
    }
    public function setPassword($pass){
        $this->password = $pass;    
    }
    public function getPassword(){
        return $this->password;    
    }
    public function setEmail($email){
        $this->email = $email;    
    }
    public function getEmail(){
        return $this->email;    
    }
    public function setFirstName($fName){
        $this->first_name = $fName;    
    }	
    public function getFirstName(){
        return $this->first_name;    
    }
    public function setLastName($lName){
        $this->last_name = $lName;    
    }
    public function getLastName(){
        return $this->last_name;    
    }
    public function setBirthDate($dob){
        $this->date_of_birth = $dob;    
    }
    public function getBirthDate(){
        return $this-> date_of_birth;    
    }
    public function setGender($gender){
        $this->gender = $gender;    
    }
    public function getGender(){
        return $this->gender;    
    }
    public function setStatus($status){
        $this->status = $status;    
    }
    public function getStatus(){
        return $this->status;    
    }	
    public function setImage($profile_pic){
        $this->profile_pic = $profile_pic;   
    }
    public function getImage(){
        return $this->profile_pic;    
    }
    public function setPrivileges($privileges){
      $this->privileges = $privileges;  
    }
    public function getPrivileges(){
      return $this->privileges;  
    }

    public static function loadUserFromUsername($username){
        $sql = 'SELECT * FROM user WHERE username = :username';

        $params = array (':username' => $username);

        $data = Database::getRow($sql, $params);
        $user = new User($data['id'], $data['username'], $data['password_hash'], $data['email'], $data['first_name'], $data['last_name'], $data['date_of_birth'], $data['gender'], $data['status'], $data['profile_image'], $data['privileges']);
        return $user;
    }

    public static function loadUserFromEmail($email){
        $sql = 'SELECT * FROM user WHERE email = :email';

        $params = array (':email' 	=> $email);

        $data = Database::getRow($sql, $params);
        $user = new User($data['id'], $data['username'], $data['password_hash'], $data['email'], $data['first_name'], $data['last_name'], $data['date_of_birth'], $data['gender'], $data['status'], $data['profile_image'], $data['privileges']);
        return $user;
    }

    public static function insertNewUser($username, $pass, $code, $email){
        $sql = 'INSERT INTO user (username, password_hash, email) VALUES (:user, :pass, :email)';
        $params = array(':user'  => $username,
            ':pass'  => $pass,
            ':email' => $email);
        $userId = Database::insert($sql, $params);
        
        self::writePasskey($code, $userId);
        LogAction::insertLog($userId, 1);
        return true;
    }

    public static function ifExists($username, $email){
        $sql = 'SELECT * FROM user WHERE username = :user OR email = :email';
        $params = array (':user'   => $username,
             ':email'  => $email);

        $result = Database::getRow($sql, $params);
        return $result;
    }	

    public static function confirmUser($pass){
        $sql = 'SELECT user_id FROM passkey WHERE passkey = :pass';
        $params = array(':pass'	=> $pass);
        $result = Database::getRow($sql, $params);
        if (!empty($result)){
          $sql = 'UPDATE user SET status = 1 WHERE id IN (SELECT t.user_id FROM passkey t WHERE t.passkey = :pass)';
          $params = array (':pass' => $pass);
          Database::update($sql, $params);
          $sql = 'DELETE FROM passkey WHERE passkey = :pass';
          $params = array (':pass' => $pass);
          Database::update($sql, $params);
          return true;
        } else{
            return false;	
        }
    }

    public static function login($username, $password){
        $sql = 'SELECT * FROM user WHERE username = :user AND password_hash = :pass';
        $params = array(':user'  => $username,
            ':pass'  => $password);

        $data = Database::getRow($sql, $params);
        if($data){
          $user = new User($data['id'], $data['username'], $data['password_hash'], $data['email'], $data['first_name'], $data['last_name'], $data['date_of_birth'], $data['gender'], $data['status'], $data['profile_image'], $data['privileges']);
          $id = $user->getUserId();
          LogAction::insertLog($id, 3);
          return true;
        } else{
          return false;
        }
    }

    public static function isLoggedIn(){
      if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
        return true;
      } else {
        return false;  
      }
    }
    
    public static function logout($username){
        $user = self::loadUserFromUsername($username);
        $id = $user->getUserId();
        LogAction::insertLog($id, 4);
        
        //delete the session vars by clearing the session array
        $_SESSION = array();

        //delete the user_id and username cookies by setting their
        //expirations to an hour ago (3600)
        if(isset($_COOKIE[session_name()])){
          setcookie('session_name', '', time() - 3600);
          setcookie('username', '', time() - 3600);
        }
        //destroy the session
        session_destroy();
    }

    public static function updatePass($newPass, $oldPass, $user){
        $salt = "egg";
        $oldPass = md5($salt.$oldPass);
        $newPass = md5($salt.$newPass);
        
        //check if old password is valid and is used by the user
        $sql = 'SELECT id FROM user WHERE username = :user AND password_hash = :oldPass';
        $params = array(':user'	=> $user,
            ':oldPass'	=> $oldPass);
        $result = Database::getRow($sql, $params);
        if (!empty($result)){
          $sql = 'UPDATE user SET password_hash = :newPass WHERE password_hash = :oldPass AND username = :user';
          $params = array(':newPass' => $newPass,
                          ':oldPass' => $oldPass,
                          ':user'    => $user);
          Database::query($sql, $params);
          $user = self::loadUserFromUsername($user);
          $id = $user->getUserId();
          LogAction::insertLog($id, 6);
          return true;
        } else{
            echo 'error in changing passwords.\n';	
        }
    }

    public static function updateProfile($first, $last, $email, $pic, $bday, $gender, $username){
        $sql = 'UPDATE user SET first_name = :first, last_name = :last, email = :email, profile_image = :pic, date_of_birth = :bday, gender = :gender WHERE username = :user';
        $params = array(':first'	=> $first,
                        ':last' 	=> $last,
                        ':email'	=> $email,
                        ':pic'	  => $pic,
                        ':bday'	  => $bday,
                        ':gender'	=> $gender,
                        ':user'	  => $username);
        Database::update($sql, $params);
        $user = self::loadUserFromUsername($username);
        $id = $user->getUserId();
        LogAction::insertLog($id, 5);
        return true;
    }

    public static function writePasskey($passkey, $user){
        $sql = 'INSERT INTO passkey (passkey, user_id, date_created) VALUES (:pass, :user, NOW())';
        $params = array(':pass'	=> $passkey,
                        ':user'	=> $user);
        Database::insert($sql, $params);
        return true;
    }

  }


?>
