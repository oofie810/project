<?php
    class User{
    
    // TODO use private values for user attributes
    private $user_id, $username, $password, $email;
    private $first_name, $last_name, $birthdate, $gender, $status;
    // TODO create construct
    // TODO create getters and setters
	// or public function User() - same as __construct
	public function __construct($user_id, $username, $password, $email,
		$first_name, $last_name, $birthdate, $gender, $status){
	    $this->setUserId($user_id);
	    $this->setUsername($username);
	    $this->setPassword($password);
	    $this->setEmail($email);
	    $this->setFirstName($first_name);
	    $this->setLastName($last_name);
	    $this->setBirthDate($birthdate);
	    $this->setGender($gender);
	    $this->setStatus($status);
	}
	public function setUserId($str){
	    $this->user_id= $str;
	}
	public function getUserId(){
	    return $this->user_id;    
	}
	public function setUsername($str) {
	    $this->username = $str;
	}
	public function getUsername(){
	    return $this->username;    
	}
	public function setPassword($str){
	    $this->password = $str;    
	}
	public function getPassword(){
	    return $this->password;    
	}
	public function setEmail($str){
	    $this->email = $str;    
	}
	public function getEmail(){
	    return $this->email;    
	}
	public function setFirstName($str){
	    $this->first_name = $str;    
	}	
	public function getFirstName(){
	    return $this->first_name;    
	}
	public function setLastName($str){
	    $this->last_name = $str;    
	}
	public function getLastName(){
	    return $this->last_name;    
	}
	public function setBirthDate($str){
	    $this->birthdate = $str;    
	}
	public function getBirthDate(){
	    return $this-> birthdate;    
	}
	public function setGender($str){
	    $this->gender = $str;    
	}
	public function getGender(){
	    return $this->gender;    
	}
	public function setStatus($str){
	    $this->status = $str;    
	}
	public function getStatus(){
	    return $this->status;    
	}	
	
	public static function load($username){
	    $db = new Database();
	    // FUTURE: $row = DB::query($sql, $params);
	    $sql = 'SELECT * FROM user WHERE username = :username';

	    $params = array (':username' => $username);

	    $db -> query ($sql, $params);

	    $row = $db -> getData();
	    #var_dump($row);
	    $user = new User($row['user_id'], $row['username'], $row['password'], $row['email'], $row['first_name'], $row['last_name'], $row['birthdate'], $row['gender'], $row['status']);
	    return $user;
	}

	public static function load_dynamic($column, $data2){
	    $db = new Database();
	    $columnName = $column;
	    // FUTURE: $row = DB::query($sql, $params);
	    $sql = 'SELECT * FROM user WHERE ' .$columnName.' = :data';

	    $params = array (':data' => $data2);

	    $db -> query ($sql, $params);

	    $row = $db -> getData();
	    $user = new User($row['user_id'], $row['username'], $row['password'], $row['email'], $row['first_name'], $row['last_name'], $row['birthdate'], $row['gender'], $row['status']);
	    #var_dump($row);
	    return $user;
	}

	public static function insertLog($user_id, $action){
	    $db = new Database();
	    $ip = $_SERVER['REMOTE_ADDR'];
	    $sql = 'INSERT INTO log (user_id, action, date, ip_addr) VALUES (:id, :action, NOW(), :ip)';

	    $params = array(':id'     => $user_id,
			    ':action' => $action,
			    ':ip'     => $ip);
	    $db -> insert ($sql, $params);
	}

	public static function insertNewUser($username, $pass, $code, $email){
	    $db = new Database();
	    $sql = 'INSERT INTO user (username, password, email) VALUES (:user, :pass, :email)';
	    $params = array(':user'  => $username,
			    ':pass'  => $pass,
			    ':email' => $email);
	    $id = $db -> insert($sql, $params);
	    
	    $sql2 = 'INSERT INTO passkey (passkey, user_id, date_created) VALUES (:code, :id, NOW())';
	    $params2 = array(':code'  => $code,
			     ':id'    => $id);
	    $db -> insert($sql2, $params2);
	    return true;
	}

	public static function ifExists($username, $email){
	    $db = new Database();
	    $sql = 'SELECT * FROM user WHERE username = :user OR email = :email';
	    $params = array (':user'   => $username,
			     ':email'  => $email);

	    $db -> query ($sql, $params);

	    $result = $db -> getData();
	    return $result;
	}	

	public static function confirmUser($pass){
	    $db = new Database();
	    $sql = 'UPDATE user SET status = 1 WHERE user_id IN (SELECT t.user_id FROM passkey t WHERE t.passkey = :pass)';
	    $params = array (':pass' => $pass);
	    $db -> query ($sql, $params);
	}
	
	public static function loggedIn($username, $password){
	    $db = new Database();
	    $sql = 'SELECT * FROM user WHERE username = :user AND password = :pass';
	    $params = array(':user'  => $username,
			    ':pass'  => $password);

	    $db -> query ($sql, $params);
	    $row = $db -> getData();
	    $user = new User($row['user_id'], $row['username'], $row['password'], $row['email'], $row['first_name'], $row['last_name'], $row['birthdate'], $row['gender'], $row['status']);
	    return $user;
	}
}

?>
