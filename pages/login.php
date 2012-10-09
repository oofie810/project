<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');

  $error_msg = "";
  
  if(isset($_POST['submit'])){
    $user_un = $_POST['username'];
    $user_pw = $_POST['password'];

    if (!empty($user_un) && !empty($user_pw)){
      $salt = "egg";
      $user_pw = md5($salt.$user_pw);
      $user = User::loadUserFromUsername($user_un);
      $status = $user->getStatus();
      if ($status == '0'){
        echo '<p class="error">Please confirm your account first.</p>';
      } else{
	  $user = User::login($user_un, $user_pw);
	  $username = $user->getUsername();
	  $_SESSION['username'] = $username;
	  setcookie('username', $username, time() + (60* 60 * 24 * 30));
      }
    }else{
      $error_msg = 'Sorry, you must enter your username and password to login.';
    }
  }
  if (!User::isLoggedIn($_SESSION['username'])){
    echo '<p class="error">' .$error_msg. '</p>'; 

?>

<form method="post" action="login.php">
  <fieldset>
     <legend>Log In</legend>
     <label for="username">Username:</label>
     <input type="text" id="username" name="username" 
         value="<?php if (!empty($user_un)) echo $user_un; ?>" /><br />
     <label for="password">Password:</label>
     <input type="password" id="password" name="password" />
   </fieldset>
 <input type="submit" value="Log In" name="submit" />
</form>

<?php
   } 
   else{
     echo('<p class="login">You are logged in as '.$_SESSION['username']. '.</p>');
     echo '<a href="index.php">Index</a>';
   }
  require_once('footer.php');
?>
