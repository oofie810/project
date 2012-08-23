<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Sign Up</title>
   <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
   <h3>Sign Up</h3>

<?php

require_once('../lib/functions.php');
require_once('../lib/connectvars.php');

//connect to the db
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('error ln 7:'.mysqli_error($dbc));

if (isset($_POST['submit'])){
$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
$pass = mysqli_real_escape_string($dbc, trim($_POST['password']));
$pass2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
$email = mysqli_real_escape_string($dbc, trim($_POST['email']));

//check if user and password are not empty. check if both passwords are teh same
if (!empty($username) && !empty($pass) && !empty($pass2) && ($pass == $pass2) && !empty($email)){

//check if there is a user already by that name in the db
$query ="SELECT * FROM user WHERE username = '$user' OR email = '$email'";

$data = mysqli_query($dbc, $query) or die ('Error ln 20:'.mysqli_error($dbc));
if (mysqli_num_rows($data) == 0){
//then user is unique. add to database. encrypt password with salt value. use md5
if (strlen($pass) >= 8){
$code = md5(uniqid(rand()));
$salt = "egg";
$pass = md5($salt.$pass);

$result = new_user_signup($username, $pass, $code, $email);
if($result){

$sent= send_email($email, $code);

if($sent){
echo '<p>Please wait for email for confirmation.</p>';
mysqli_close($dbc);
exit();
}
}
}
else{
  echo '<p class="error">The password must be at least 8 characters.</p>';
	}

 }
else{
//an account already exists for the username
echo '<p class="error">An account already exists for this username / email. Please use a different one.</p>';
   $user = "";
}
}

else {
echo '<p class="error">You must enter all of the data needed.</p>';
}
}

mysqli_close($dbc);
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
