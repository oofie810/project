<?php
  $css_files =array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');

  if(User::isLoggedIn($_SESSION['username'])){
    $user = $_SESSION['username'];

    if (isset($_POST['submit'])){
      $pass1 = $_POST['password1'];
      $pass2 = $_POST['password2'];
      $oldpass = $_POST['oldpass'];

      if (!empty($pass1) && !empty($pass2) && !empty($oldpass) && ($pass1 == $pass2)){
        $update = User::updatePass($pass1, $oldpass, $user);
        if ($update){
          echo '<div class="success">Your password has been changed.</div>';	
        } else{
            echo '<div class="error">Please make sure you entered the right password</div>';
        } 
      } else{
          echo '<div class="error">You must provide the old password and the new password or double check that the new passwords are the same.</div>';
      }   
    }
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="genericform" id="usersettingsform">
  <fieldset>
    <legend>User Settings</legend>
    <label for="oldpass">Old Password:</label>
    <input type="password" id="oldpass" name="oldpass"><br />
    <label for="password1">New Password:</label>
    <input type="password" id="password1" name="password1"><br />
    <label for="password2">New Password (retype):</label>
    <input type="password" id="password2" name="password2"><br />
    <input type="submit" value"Submit" name="submit" />
  </fieldset>
</form>

<?php
  } else{
      echo '<div class="error">You must be logged in. Log in <a href="login.php">here</a></div>';
  }

  require_once('footer.php');

?>
