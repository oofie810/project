<?php
  $css_files=array('index.css');
  require_once('../lib/appvars.php');
  require_once('header.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');
  require_once('../lib/Ingredient.php');
  require_once('../config/Config.php');
  include_once('sidebar2.php');
?>
  <div id="main">
<?php
  if(User::isLoggedIn()){ 
    $username = $_SESSION['username'];
    $user = User::loadUserFromUsername($username);
    $user_id = $user->getUserId();
    echo '<fieldset id="viewprofile">';
    echo '<legend>User Info</legend>';
    echo '<table>';
    echo '<tr><td class="label">Username:</td><td>' .$user->getUsername(). '</td></tr>';
    echo '<tr><td class="label">First Name:</td><td>' .$user->getFirstName(). '</td></tr>';
    echo '<tr><td class="label">Last Name:</td><td>' .$user->getLastName(). '</td></tr>';
    echo '<tr><td class="label">Email:</td><td>' .$user->getEmail(). '</td></tr>';
    echo '<tr><td class="label">Gender:</td><td>' .$user->getGender() .'</td></tr>';
    echo '<tr><td class="label">Birthdate:</td><td>' .$user->getBirthDate().'</td></tr>';
    echo '<tr><td class="label">Image:</td><td><img src= "'. Config::getAwsFolder() . 'thumb_' . $user->getImage() .'" alt="Profile Picture" /></td></tr>';
    echo '</table><br />';
    echo '</fieldset>';
    echo '<table>';
     
    echo '<a href="editrecipe.php?user_id=' .$user->getUserId() . '">Edit Your Recipes</a>';
    $recipes_submitted = Recipe::loadRecipeByUser($user_id);
    foreach($recipes_submitted as $recipe){
      echo '<ul>';
      echo '<li><a href="viewrecipe.php?recipe_id=' . $recipe->getRecipeId() . '">' .$recipe->getRecipeName() . ' </a></li>';
      echo '<li>' . substr($recipe->getDirections(), 0, 100) . '... </li>';
      echo '</ul>';
    }
  } else{
      echo '<p class="error">You must be logged in to view this page. You can log in <a href='.
	         '"login.php">here</a> or you can sign up <a href="signup.php">here</a></p>'; 
  }	
  
?>
  </div> <!-- END MAIN -->
<?php
  require_once('footer.php');
?>
