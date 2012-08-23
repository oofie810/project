<?php
  // session_destroy();
   require_once('../lib/header.php');
   require_once('../lib/functions.php');
   require_once('../lib/connectvars.php');

   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

   $passkey=mysqli_real_escape_string($dbc, trim($_GET['passkey']));
   
   //check if passkey is still in the db
   $query = "SELECT user_id FROM passkey WHERE passkey = '$passkey'";
   $data = mysqli_query($dbc, $query);
   
   if (mysqli_num_rows($data) == 1){
      $query = "UPDATE user SET status = 1 WHERE user_id IN (SELECT t.user_id FROM passkey t WHERE t.passkey= '$passkey')";
   
      mysqli_query($dbc, $query) or die ('Error ln 10:'.mysqli_error($dbc));
   
      $query ="SELECT username FROM user INNER JOIN passkey ON (user.user_id = passkey.user_id)  WHERE passkey = '$passkey'";
      $data = mysqli_query($dbc, $query) or die('error ln 19: '.mysqli_error($dbc));
      $row = mysqli_fetch_array($data);
      $username = $row['username'];
         echo $username, $passkey;
         logaction($username, 2);
         echo $passkey;
         echo '<p>you are now confirmed. Click here to <a href="login.php">login</a></p>'; 
      $query = "DELETE FROM passkey WHERE passkey = '$passkey'";
      mysqli_query($dbc, $query);
      mysqli_close($dbc);
      }
    else{
        echo '<p class="error">You have an invalid or expired confirmation email.</p>';
       
echo '<p>Click <a href="../lib/resendemail.php">here </a>to ask for another confirmation email. Or click <a href="signup.php">here</a> to Register.</p>';

      }
      require_once('../lib/footer.php');
?>
