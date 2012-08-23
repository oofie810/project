<?php
  
  require_once('../lib/connectvars.php');
  require_once('../lib/functions.php');
  //connect to db
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('error ln 5: '.mysqli_error($dbc));

  //get email from submit button
  if (isset($_POST['submit'])){
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
  
  //check if email/user is active already 
  $query = "SELECT status FROM user WHERE email = '$email'";
  $data = mysqli_query($dbc, $query) or die ('error ln 14: '.mysqli_error($dbc));
  $row = mysqli_fetch_array($data);

  $status = $row['status'];

  //if status is 0, send another confirmation email
  if (($status) == 0){  
     $code = md5(uniqid(rand()));
     $sent = send_email($email, $code);   
     $id = get_user_id_from_email($email);

     $query = "INSERT INTO passkey (passkey, user_id, date_created) VALUES ('$code', $id, NOW())";
     mysqli_query($dbc, $query);
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
