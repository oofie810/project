<?php
  session_start();
  require_once ('../lib/functions.php');
  //if user is logged in, delete the cookie and log them out
  if (isset($_SESSION['username'])){
     //log action before session is destroyed
     logaction($_SESSION['username'], 4);
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

    $home_url = 'http://192.168.1.103/index.php';
    header('Location: ' . $home_url);
?>

