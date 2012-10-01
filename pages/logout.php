<?php
  $css_files = array('index.css');
  require_once('../lib/header.php');
  require_once ('../lib/functions.php');
  require_once('../lib/Database.php');
  require_once('../lib/User.php');
  require_once('../lib/LogAction.php');

  //if user is logged in, delete the cookie and log them out
  if (isset($_SESSION['username'])){
     //log action before session is destroyed
     $id = get_user_id_from_username($_SESSION['username']);
     LogAction::insertLog($id, 4);   
     //DELETE THE SESSION VARS BY CLEARING THE SESSION ARRAY
     $_SESSION = array();
     
     //delete the user id and username cookies by setting their expirations to an hour ago (3600)
     if (isset($_COOKIE[session_name()])){
     setcookie('session_name', '', time()-3600);
     }	
  }  
  //destroy the session
  session_destroy();

  setcookie('username', '', time()-3600);
 // setcookie('user_id', '', time()-3600);

    $home_url = 'http://192.168.1.103';
    header('Location: ' . $home_url);
?>

