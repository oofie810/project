<?php
  $css_files = array('index.css');
  require_once('../lib/SendEmail.php');
  require_once('header.php');
  require_once('../lib/Database.php');
  include_once('sidebar.php');
?>
  <div id="main">
<?php
  if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];
    $email = $_POST['email'];

    //check if user and password are not empty. check if both passwords are teh same
    if (!empty($username) && !empty($pass) && !empty($pass2) && ($pass == $pass2) && !empty($email)){

      //check if there is a user already by that name in the db
      $result = User::ifExists($username, $email);
      if ($result == 0){
        //then user is unique. add to database. encrypt password with salt value. use md5
        if (strlen($pass) >= 8){
          $code = md5(uniqid(rand()));
          $salt = "egg";
          $pass = md5($salt.$pass);

          User::insertNewUser($username, $pass, $code, $email);
          $sent= SendEmail::send($email, $code);
          if($sent){
            echo '<div class="success">Please wait for email for confirmation.</div>';
            exit();
          }
        } else {
            echo '<div class="error">The password must be at least 8 characters.</div>';
        }
      } else{
          //an account already exists for the username
          echo '<div class="error">An account already exists for this username / email. Please use a different one.</div>';
          $user = "";
      }
    } else {
        echo '<div class="error">You must enter all of the data needed.</div>';
    }
  }
?>

  <p class="heading">Please enter your desired username and password.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="genericform" id="signupform">
    <fieldset>
      <legend>Registration Info</legend>
      <label for="email">Email:</label>
      <input type="text" id="email" name="email"/><br />
      <label for="username">Username:</label>
      <input type ="text" id ="username" name="username"/><br />
      <label for="password">Password (must be at least 8 characters):</label><br />
      <input type="password" id="password" name="password"/><br />
      <label for="password2">Retype Password:</label>
      <input type="password" id="password2" name="password2"/><br />
      <input type="submit" value="Sign Up" name="submit" />
      </fieldset>
    </form>
  </div> <!-- END MAIN -->
<?php require_once('footer.php'); ?>
