<?php
  $x = 'index';
  session_start();
  require_once('../lib/header.php');
  require_once('../lib/connectvars.php');
  require_once ('../lib/functions.php');
  $error_msg = "";
  
// if(!isset($_SESSION['username'])){
  if(isset($_POST['submit'])){

   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('error ln 10:'.mysqli_error($dbc));

  $user_un = mysqli_real_escape_string($dbc, trim($_POST['username']));
  $user_pw = mysqli_real_escape_string($dbc, trim($_POST['password']));

  if (!empty($user_un) && !empty($user_pw)){
     $salt = "egg";
     $user_pw = md5($salt.$user_pw);
     $query = "SELECT user_id, username, status FROM user WHERE username = '$user_un' AND password = '$user_pw'";
     $data = mysqli_query($dbc, $query);

     if (mysqli_num_rows($data) == 1){
       $row = mysqli_fetch_array($data);
       if ($row['active'] == '0'){
          echo '<p class="error">Please confirm your account first.</p>';
          }
       else{
       $_SESSION['username'] = $row['username'];
       setcookie('username', $row['username'], time() + (60* 60 * 24 * 30));
         //log action if db connects and user is logged in
         logaction($_SESSION['username'], 3);
         }
      mysqli_close($dbc);
        }
      
  else{
      $error_msg = 'Sorry, you must enter a valid username and password.';
      }
     }
  else{
      $error_msg = 'Sorry, you must enter your username and password to login.';
      }
    }
  if (empty($_SESSION['username'])){
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
require_once('../lib/footer.php');
?>
