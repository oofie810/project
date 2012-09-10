<?php
//edited 9/3/12 using user object 
  $x = 'editprof';
  session_start();
  require_once('../lib/header.php');
  require_once('../lib/appvars.php');
  require_once('../lib/connectvars.php');
  require_once ('../lib/functions.php');
  require_once('../lib/database.php');
  require_once('../lib/class.php');

if(isset($_SESSION['username'])){ 
  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('Error ln 8:'.mysqli_error($dbc));

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $user_pic = mysqli_real_escape_string($dbc, trim($_FILES['picture']['name']));
    $birthdate = mysqli_real_escape_string($dbc, trim($_POST['birthdate']));
    $gender = mysqli_real_escape_string($dbc, trim($_POST['gender'])); 
  
    if(!empty($first_name) && !empty($last_name) && !empty($email)) {
       if (check_email($email)){   
	 if (!empty($user_pic)){
            $target = UP_PATH . $user_pic;
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)){
            $query = "UPDATE user SET first_name ='$first_name', last_name='$last_name', email='$email', image = '$user_pic', birthdate = '$birthdate', gender='$gender' WHERE username ='" .$_SESSION['username'] . "'";
              }
            }
	else{
	  $query ="UPDATE user SET first_name ='$first_name', last_name='$last_name', email='$email', birthdate = '$birthdate', gender='$gender' WHERE username = '" . $_SESSION['username'] ."'";
            }
	$connect = mysqli_query($dbc, $query) or die ('Error ln 32:'.mysqli_error($dbc));
        
       if($connect){
        $ip = $_SERVER['REMOTE_ADDR'];
        echo '<p>Your profile has been updated. Click <a href="viewprofile.php">here</a> to view your profile</p>';  
         logaction($_SESSION['username'], 5, $ip);
        
      mysqli_close($dbc);
      exit();
	     }
           }
	else{
	    echo '<p class="error">Please provide a valid email address.</p>';
	    }
	}
        else {
	echo '<p class="error">Please provide the necessary information.</p>';
             }	
}
else{
    $id = $_SESSION['username'];
    $user = User::load($id);
   
      $first_name = $user->getFirstName();;
      $last_name = $user->getLastName();;
      $email = $user->getEmail();
      $gender = $user->getGender();  
      $birthdate = $user->getBirthDate();
 
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
     <table>
	<caption>Personal Information</caption>
	<tr>
	    <th>First Name:</th>
	    <td><input type="text" id="firstname" name="firstname" value="<?php if(isset($first_name)) echo $first_name; ?>" /></td>
	</tr>
	<tr>
	    <th><label for="lastname">Last Name:</label></th>
	    <td><input type="text" id="lastname" name="lastname" value="<?php if(!empty($last_name)) print $last_name; ?>" /></td>
	</tr>
	<tr>
	    <th>Email:</th>
	    <td><input size="35" type="text" id="email" name="email" value="<?php if(!empty($email)) echo $email; ?>" /></td>
	</tr>
	<tr>
	    <th><label for="birthdate">Birthdate (YYYY/MM/DD):</label></th>
	    <td><input type="text" id="birthdate" name="birthdate" value="<?php if(!empty($birthdate)) echo $birthdate; ?>" /></td>
	</tr>
	<tr>
	    <th><label for="gender">Gender:</label></th>
	    <td><select if="gender" name="gender">
	    <option value="M" <?php if(!empty($gender) && $gender == 'M') echo 'selected = "selected"';?>>Male</option>
	    <option value="F" <?php if(!empty($gender) && $gender == 'F') echo 'selected = "selected"';?>>Female</option>
	    </select></td>
	</tr>
	<tr>
	    <th><label for="picture">Picture:</label></th>
	    <td><input type="file" id="picture" name="picture" /></td>
	</tr>
	<tr>
	<th></th>
	<td>
	<input id="button" type ="submit" value="Save" name="submit" />
	</td>
	</tr>
   </table>
</form>
</body>
</html>
<?php
}

else{
echo '<p>You need to be logged in to access this page. You can login<a href='.
    '"login.php"> here</a> or sign up <a href="signup.php">here.</a></p>'; 
}
function check_email ($email){

if (preg_match('/[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)){
   $domain = preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/' ,'' , $email);
      if (!checkdnsrr($domain)){
         return false;
	}
     return true;
    }
   return false;
}
require_once('../lib/footer.php');
?>
   
