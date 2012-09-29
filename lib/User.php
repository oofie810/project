<?php
    class User{
    
    private $user_id, $username, $password, $email;
    private $first_name, $last_name, $birthdate, $gender, $status, $image;
    public function __construct($user_id, $username, $password, $email,
				$first_name, $last_name, $birthdate, $gender, $status, $image){
	    $this->setUserId($user_id);
	    $this->setUsername($username);
	    $this->setPassword($password);
	    $this->setEmail($email);
	    $this->setFirstName($first_name);
	    $this->setLastName($last_name);
	    $this->setBirthDate($birthdate);
	    $this->setGender($gender);
	    $this->setStatus($status);
	    $this->setImage($image);
	}
	public function setUserId($id){
	    $this->user_id= $id;
	}
	public function getUserId(){
	    return $this->user_id;    
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
	public function setBirthDate($date){
	    $this->birthdate = $date;    
	}
	public function getBirthDate(){
	    return $this-> birthdate;    
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
	public function setImage($img){
	    $this->image = $img;   
	}
	public function getImage(){
	    return $this->image;    
	}
	
	public static function load($username){
	    $sql = 'SELECT * FROM user WHERE username = :username';

	    $params = array (':username' => $username);

	    $data = Database::getData($sql, $params);
	    $user = new User($data['user_id'], $data['username'], $data['password'], $data['email'], $data['first_name'], $data['last_name'], $data['birthdate'], $data['gender'], $data['status'], $data['image']);
	    return $user;
	}

	public static function load_dynamic($column, $data2){
	    $sql = 'SELECT * FROM user WHERE '.$column.' = :data';

	    $params = array (':data' 	=> $data2);

	    $data = Database::getData($sql, $params);
	    $user = new User($data['user_id'], $data['username'], $data['password'], $data['email'], $data['first_name'], $data['last_name'], $data['birthdate'], $data['gender'], $data['status'], $data['image']);
	    return $user;
	}

	public static function insertNewUser($username, $pass, $code, $email){
	    $sql = 'INSERT INTO user (username, password, email) VALUES (:user, :pass, :email)';
	    $params = array(':user'  => $username,
			    ':pass'  => $pass,
			    ':email' => $email);
	    $id = Database::insert($sql, $params);
	    
	    writePasskey($code, $id);
	    return true;
	}

	public static function ifExists($username, $email){
	    $sql = 'SELECT * FROM user WHERE username = :user OR email = :email';
	    $params = array (':user'   => $username,
			     ':email'  => $email);

	    $result = Database::getData($sql, $params);
	    return $result;
	}	

	//TODO fix this function. incomplete
	public static function confirmUser($pass){
	    $sql = 'SELECT user_id FROM passkey WHERE passkey = :pass';
	    $params = array(':pass'	=> $pass);
	    $data = Database::getData($sql, $params);
	    if ($data){
		$sql = 'UPDATE user SET status = 1 WHERE user_id IN (SELECT t.user_id FROM passkey t WHERE t.passkey = :pass)';
		$params = array (':pass' => $pass);
		Database::update($sql, $params);
		//delete passkey after status is updated
	    }
	    else{
		return false;	
	    }
	}

	public static function login($username, $password){
	    $sql = 'SELECT * FROM user WHERE username = :user AND password = :pass';
	    $params = array(':user'  => $username,
			    ':pass'  => $password);

	    $data = Database::getData($sql, $params);
	    if($data){
		$user = new User($data['user_id'], $data['username'], $data['password'], $data['email'], $data['first_name'], $data['last_name'], $data['birthdate'], $data['gender'], $data['status'], $data['image']);
		return $user;
	    }
	    else{
		echo 'You have entered an invalid username of password. Please try again';	
	    }
	}

	public static function updatePass($newPass, $oldPass, $user){
	    $salt = "egg";
	    $oldPass = md5($salt.$oldPass);
	    $newPass = md5($salt.$newPass);
	    
	    //check if old password is valid and is used by the user
	    $sql = 'SELECT user_id FROM user WHERE username = :user AND password = :oldPass';
	    $params = array(':user'	=> $user,
			    ':oldPass'	=> $oldPass);
	    $data = Database::getData($sql, $params);
	    if ($data){
		$sql = 'UPDATE user SET password = :newPass WHERE password = :oldPass AND username = :user';
		$params = array(':newPass' => $newPass,
			    ':oldPass' => $oldPass,
			    ':user'    => $user);
		Database::query($sql, $params);
		return true;
	    }
	    else{
		echo 'error in changing passwords.\n';	
	    }
	}

	public static function updateProfPic($first, $last, $email, $pic, $bday, $gender, $username){
	    $sql = 'UPDATE user SET first_name = :first, last_name = :last, email = :email, image = :pic, birthdate = :bday, gender = :gender WHERE username = :user';
	    $params = array(':first'	=> $first,
			    ':last' 	=> $last,
			    ':email'	=> $email,
			    ':pic'	=> $pic,
			    ':bday'	=> $bday,
			    ':gender'	=> $gender,
			    ':user'	=> $username);
	    Database::update($sql, $params);
	    return true;
	}

	public static function updateProf($first, $last, $email, $bday, $gender, $username){
	    $sql = 'UPDATE user SET first_name = :first, last_name = :last, email = :email, birthdate = :bday, gender = :gender WHERE username = :user';

	    $params = array(':first'	=> $first,
			    ':last' 	=> $last,
			    ':email'	=> $email,
			    ':bday'	=> $bday,
			    ':gender'	=> $gender,
			    ':user'	=> $username);
	    Database::update($sql, $params);
	    return true;
	}

	public static function writePasskey($passkey, $user){
	    $db = new Database();
	    $sql = 'INSERT INTO passkey(passkey, user_id, date_created) VALUES (:pass, :user, NOW())';
	    $params = array(':pass'	=> $passkey,
			    ':user'	=> $user);
	    Database::insert($sql, $params);
	    return true;
	}
}


?>
