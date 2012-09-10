<?
/*
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;




class DB {
	private $host, $user, $password, $db;
	public function  __construct($host, $user, $password, $db){}
	public function get($sql) {}
	public function update($sql) {}
}

class User {
	private $user_id, $username, $password, $email, $first_name, $last_name, $image, $birthdate, $gender, $status;
	public function __construct($user_id, $username, $password, $email, $first_name, $last_name, $image, $birthdate, $gender, $status) {}

	public static function  load($id) {
		$DB = new DB($host, $user, $password, $db);
		$sql = "select * from user where user = " . $id;
		$user_rec = $DB->get($sql);
		$user = new User($user_rec['user_id'], ...);
	}

	public function save($user_id, $username, $password, ...) {
		Run SQL Here
		Update your object here
	}

	
}
*/
?>
