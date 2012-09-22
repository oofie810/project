<?php
  $x = 'index';
  require_once ('../lib/functions.php');
  require_once('../lib/connectvars.php');
  require_once('../lib/header.php');
  require_once('../lib/Database.php');
  require_once('../lib/User.php');
  require_once('../lib/LogAction.php');

if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];

    if (isset($_POST['submit'])){
	$pass1 = $_POST['password1'];
	$pass2 = $_POST['password2'];
	$oldpass = $_POST['oldpass'];

	if (!empty($pass1) && !empty($pass2) && !empty($oldpass) && ($pass1 == $pass2)){
	    $update = User::updatePass($pass1, $oldpass, $user);
	    if ($update){
		//log action if user changes passwords
		$id = get_user_id_from_username($user);
		LogAction::insertLog($id, 6);
		echo '<p>Your password has been changed.</p>';	
	    }
	    else{
		echo 'Please make sure you entered the right password';
	    }
	}
	else{
	    echo '<p class="error">You must provide the old password and the new password or double check that the new passwords are the same.</p>';
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
