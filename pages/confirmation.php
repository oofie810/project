<?php
   $x = 'index';
   require_once('../lib/header.php');
   require_once('../lib/functions.php');
   require_once('../lib/connectvars.php');
   require_once('../lib/database.php');
   require_once('../lib/class.php');
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

   $passkey=$_GET['passkey'];
   
    $confirmed =  User::confirmUser($passkey);
      if ($confirmed){
	echo '<a href="../pages/index.php>Index</a>';
      }
    else{
        echo '<p class="error">You have an invalid or expired confirmation email.</p>';
   
echo '<p>Click <a href="../lib/resendemail.php">here </a>to ask for another confirmation email. Or click <a href="signup.php">here</a> to Register.</p>';

    }
      require_once('../lib/footer.php');
?>
