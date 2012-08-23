<?php
  $x = 'index';
  session_start();
  require_once ('../lib/functions.php');
  require_once('../lib/connectvars.php');
  require_once('../lib/header.php');

if(isset($_SESSION['username'])){
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if (isset($_POST['submit'])){
  $pass1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
  $pass2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
  $oldpass = mysqli_real_escape_string($dbc, trim($_POST['oldpass']));

  if (!empty($pass1) && !empty($pass2) && !empty($oldpass) && ($pass1 == $pass2)){
     $salt = "egg";
     $oldpass = md5($salt.$oldpass);
     
     //check if old password is valid / in the db
     $query = "SELECT user_id FROM user WHERE password = '$oldpass' AND username = '".$_SESSION['username']."'";
     $data = mysqli_query($dbc, $query) or die ('Error ln 19:'.mysqli_error($dbc));
     if (mysqli_num_rows($data) == 1){
       $pass1 = md5($salt.$pass1);
       $query = "UPDATE user SET password = '$pass1' WHERE password = '$oldpass' AND username = '".$_SESSION['username']."'";

       $connect = mysqli_query($dbc, $query) or die ('Error ln 24:'.mysqli_error($dbc));
       
       if ($connect){
	   //log action if user changes passwords
	   logaction($_SESSION['username'], 6);
           }
       mysqli_close($dbc);
       //confirm to user that password was changed
       echo '<p>Your password has been changed.</p>';	
       }
   else{
     echo '<p class="error">You entered an invalid old password.</p>';
      }

  }
  else{
     echo '<p class="error">You must provide the old password and the new password.</p>';
     }
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <fieldset>
    <legend>User Settings</legend>
    <label for="oldpass">Old Password:</label>
    <input type="password" id="oldpass" name="oldpass"><br />
    <label for="password1">New Password:</label>
    <input type="password" id="password1" name="password1"><br />
    <label for="password2">New Password (retype):</label>
    <input type="password" id="password2" name="password2"><br />
  </fieldset>
 <input type="submit" value"Submit" name="submit" />
</form>

<?php
}
 else{
 echo '<p class="error">You must be logged in. Log in <a href="login.php">here</a></p>';
 }

require_once('../lib/footer.php');

?>
