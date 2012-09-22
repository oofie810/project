<?php
    $x = 'index';
    require_once ('../lib/connectvars.php');
    require_once ('../lib/header.php');
    require_once ('../lib/Database.php');
    require_once ('../lib/User.php');
    require_once ('../lib/Recipe.php');
    require_once ('../lib/Ingredient.php');
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
*/   # echo "class";
    #$id = $_SESSION['username'];
   # $data = 'username';
   # echo $id;
   # $bar = User::load($id);
   # echo "username:";
   # echo $bar->getUsername();
   # $foo = User::load_dynamic($data, $id);
    #echo "back to main";
    #echo $foo->getUsername();
    #echo $foo -> getLastName();
    $ip = $_SERVER['PHP_SELF'];
    echo $ip;
    $rec = '101';
    $array = Ingredient::loadAllIngr($rec);
    #var_dump($array);
    foreach($array as $key=>$array){
	echo "<br />";
	echo $array -> getIngredient();	
    }
 /*   $db = new Database();
    $sql = 'update user set status = 1 WHERE username = :id';
    $params = array (':id' => 'ronald');
    $db -> query($sql, $params);
    $data = $db->getData();
    var_dump($data);
*/
 //   $data = Recipe::loadAll();
   // $count = count($data);
    //foreach ($data as $row){
//	echo $row['rec_id'];
//	echo $row['rec_name'];
//	echo "\n\n";
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
