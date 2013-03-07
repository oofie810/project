<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');

  $passkey = $_GET['passkey'];
   
  $confirmed =  User::confirmUser($passkey);
  if ($confirmed){
    echo 'Thank you for confirming. Please click <a href="login.php">here</a> to login';
  } else{
    echo '<p class="error">You have an invalid or expired confirmation email.</p>';
    echo '<p>Click <a href="resendemail.php">here </a>to ask for another confirmation email. Or click <a href="signup.php">here</a> to Register.</p>';

  } 

  require_once('footer.php');
?>

