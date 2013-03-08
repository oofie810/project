<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');
  include_once('sidebar2.php');
?>
  <div id="main">
<?php
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
        echo '<div class="error">Please confirm your account first.</div>';
      } else{
          $login = User::login($user_un, $user_pw);
          if(!empty($login)){
            $username = $user->getUsername();
            $_SESSION['username'] = $username;
            setcookie('username', $username, time() + (60* 60 * 24 * 30));
          } else{
            echo 'You have entered an invalid username or password. Please try again.';  
          }
      }
    }else{
      $error_msg = 'Sorry, you must enter your username and password to login.';
    }
  }
  if (!User::isLoggedIn($_SESSION['username'])){
    if (!empty($error_msg)) {
      echo '<div class="error">' .$error_msg. '</div>'; 
    }
?>

<form method="post" action="login.php" class="genericform" id="loginform">
  <fieldset>
    <legend>Log In</legend>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" 
       value="<?php if (!empty($user_un)) echo $user_un; ?>" /><br />
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" />
    <div class="clearboth"></div>
    <input type="submit" value="Log In" name="submit" />
  </fieldset>
</form>

</div> <!-- END MAIN -->
<?php
   } else{
       Header("Location: /");
       exit();
   }

  require_once('footer.php');
?>
