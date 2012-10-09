<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');

  $passkey=$_GET['passkey'];
   
  $confirmed =  User::confirmUser($passkey);
  if ($confirmed){
    echo '<a href="../pages/index.php>Index</a>';
  } else{
      echo '<p class="error">You have an invalid or expired confirmation email.</p>';
      echo '<p>Click <a href="../lib/resendemail.php">here </a>to ask for another confirmation email. Or click <a href="signup.php">here</a> to Register.</p>';

  } 
  require_once('footer.php');
?>
