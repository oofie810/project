<?php
  $css_files = array('index'); 
  require_once('../lib/header.php');
  require_once('../lib/Database.php');
  require_once('../lib/User.php');
  
  //get email from submit button
  if (isset($_POST['submit'])){
    $email = $_POST['email'];
  
  //check if email/user is active already 
  $column = 'email';
  $user = User::loadUserFromEmail($column, $email);
  $status = $user->getStatus();

  //if status is 0, send another confirmation email
  if (($status) == 0){  
     $passkey = md5(uniqid(rand()));
     $sent = send_email($email, $code);   
     $id = $user->getUserId();
     User::writePasskey($passkey, $id);
     echo '<p>Please wait for the confirmation email.</p>';
     }
  else{
    echo '<p>This account is already confirmed. Click <a href="login.php">here</a> to log in.</p>';
      }
   }     

?>

<p>Please enter your email address.</p>
   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <label for="email">Email:</label>
   <input type="text" id="email" name="email"/><br />
   <input type="submit" value="Submit" name="submit" />
  </form>

<?php require_once('../lib/footer.php'); ?>
