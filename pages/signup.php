<?php
  $css_files = array('index.css');
  require_once('../lib/SendEmail.php');
  require_once('header.php');
  require_once('../lib/Database.php');

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
            echo '<p>Please wait for email for confirmation.</p>';
            exit();
          }
        } else {
            echo '<p class="error">The password must be at least 8 characters.</p>';
        }
      } else{
          //an account already exists for the username
          echo '<p class="error">An account already exists for this username / email. Please use a different one.</p>';
          $user = "";
      }
    } else {
        echo '<p class="error">You must enter all of the data needed.</p>';
    }
  }
?>

<p>Please enter your desired username and password.</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <fieldset>
    <legend>Registration Info</legend>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email"/><br />
    <label for="username">Username:</label>
    <input type ="text" id ="username" name="username"/><br />
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"/><br />
    <label for="password2">Password (retype):</label>
    <input type="password" id="password2" name="password2"/><br />
  </fieldset>
 <input type="submit" value="Sign Up" name="submit" />
</form>
</html>


<?php require_once('footer.php'); ?>
