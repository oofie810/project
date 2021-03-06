<?php
  $css_files=array('index.css');
  require_once('header.php');
  require_once('../lib/appvars.php');
  require_once('../lib/Database.php');
  require_once('../config/Config.php');
  require_once('../lib/Image.php');

  include_once('sidebar2.php');
?>
  <div id="main">
<?php
  if(User::isLoggedIn()){ 
    $username = $_SESSION['username'];

    if (isset($_POST['submit'])) {
      // Grab the profile data from the POST
      $first_name =$_POST['firstname'];
      $last_name  =$_POST['lastname'];
      $email      =$_POST['email'];
      $user_pic   =$_FILES['picture']['name'];
      $birthdate  =$_POST['birthdate'];
      $gender     =$_POST['gender']; 

      //TODO figure out a way to update profile without new pic. right now,
      //it deletes image if nothing is uploaded.
      if (!empty($user_pic)){
        if ($_FILES['picture']['size'] < 1024000){
        Image::saveUserImageS3($user_pic, $username);
        } else{
          echo '<div class="error">User image must be less than 1000kb.</div>';  
        }
      }

      if(!empty($first_name) || !empty($last_name) || !empty($email)) {
        if (check_email($email)){   
          $update =User::updateProfile($first_name, $last_name, $email, $user_pic, $birthdate, $gender, $username);
          if($update){
            echo '<div class="success">Your profile has been updated. Click <a href="viewprofile.php">here</a> to view your profile</div>';  
            }
        }else{
            echo '<div class="error">Please provide a valid email address.</div>';
        }
      } else {
          echo '<div class="error">Please provide the necessary information.</div>';
      }	
    } else{
        $user = User::loadUserFromUsername($username);
        $first_name = $user->getFirstName();;
        $last_name = $user->getLastName();;
        $email = $user->getEmail();
        $gender = $user->getGender();  
        $birthdate = $user->getBirthDate();
    }
?>



<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="genericform" id="editprofileform">
  <fieldset>
        <legend>Edit Profile</legend>
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" value="<?php if(isset($first_name)) echo $first_name; ?>" />
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" value="<?php if(!empty($last_name)) print $last_name; ?>" />
        <label for="email">Email:</label>
        <input size="35" type="text" id="email" name="email" value="<?php if(!empty($email)) echo $email; ?>" />
        <label for="birthdate">Birthdate (YYYY/MM/DD):</label>
        <input type="text" id="birthdate" name="birthdate" value="<?php if(!empty($birthdate)) echo $birthdate; ?>" /><br />
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
        <option value="M" <?php if(!empty($gender) && $gender == 'M') echo 'selected = "selected"';?>>Male</option>
        <option value="F" <?php if(!empty($gender) && $gender == 'F') echo 'selected = "selected"';?>>Female</option>
        </select>
        <label for="picture">Picture: (file size must be less than 1000kb)</label>
        <input type="file" id="picture" name="picture" />
        <div class="clearboth"></div>
        <input id="button" type ="submit" value="Save" name="submit" />
  </fieldset>
</form>
<?php
  } else{
      echo '<div class="error">You need to be logged in to access this page. You can login<a href='.
           '"login.php"> here</a> or sign up <a href="signup.php">here.</a></div>'; 
  }

?>
  </div> <!--END MAIN -->
<?php

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

require_once('footer.php');
?>
   
