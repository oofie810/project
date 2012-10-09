<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');

  //if user is logged in, delete the cookie and log them out
  if (User::isLoggedIn($_SESSION['username'])){
    //send session username to user::logout function
    User::logout($_SESSION['username']);
  }	

  //redirect to home url after user is logged out
  $home_url = '/';
  header('Location: ' . $home_url);
  
  require_once('footer.php');
?>

