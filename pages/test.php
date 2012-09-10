<?php
    $x = 'index';
    session_start();
    require_once ('../lib/connectvars.php');
    require_once ('../lib/header.php');
    require_once ('../lib/database.php');
    require_once ('../lib/class.php');
    
   // if(isset($_SESSION['username'])){
   /* try {

	$id = $_SESSION['username'];
	//$id = 'ronald';
	//$conn = new PDO('mysql:host=localhost; dbname=project', DB_USER, DB_PASS);
	//$conn -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn = new Database();

	//$data = $conn->prepare('SELECT * FROM user WHERE username = :id');
	//$data -> execute(array('id' => $id));

	while($row = $data->fetch()){
	    echo $row['username'];
	
	    }
    } catch(PDOException $e){
	echo 'ERROR: ' . $e->getMessage();
	}
*/
    echo "class";
    $id = $_SESSION['username'];
    echo $id;
    $data = 'username';
    echo $id;
    $foo = User::load_dynamic($data, $id);
    echo $foo->getUsername();
    echo $foo -> getLastName();
  /* 
    $db = new Database();

    $sql = 'SELECT * FROM user WHERE username = :id';

    $params = array(':id' => $id);

    $db -> query($sql, $params);

    $result = $db ->getData();

    echo $result["username"]; 
    echo $result["last_name"];

*/
    //echo var_dump ($result);
 //}
?>
