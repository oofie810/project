<?php
  $css_files=array('index.css');
  require_once('../lib/appvars.php');
  require_once('header.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');
  require_once('../lib/Ingredient.php');
  require_once('../config/Config.php');
  include_once('sidebar.php');
?>
  <div id="main">
<?
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
    echo '<tr><td class="label">Image:</td><td><img src= "'. Config::getImageFolder() . 'user_images/resized/' . $user->getImage() .'" alt="Profile Picture" /></td></tr>';
    echo '</table><br />';
    echo '</fieldset>';
    echo '<table>';
      
    $recipes_submitted = Recipe::loadRecipeByUser($user_id);
    foreach($recipes_submitted as $recipe){
      echo '<ul>';
      echo '<li>Name: ' .$recipe->getRecipeName() . ' </li>';
      echo '<li>Ingredients: </li>';
      foreach($recipe->getIngredients() as $ingr){
        echo $ingr->getAmount() . ' ' .$ingr->getUnitName() . ' ' . $ingr->getName() . '<br />';  
      }
      echo '<li>Directions:  ' . $recipe->getDirections() . ' </li>';
      echo '</ul>';
    }
  } else{
      echo '<p class="error">You must be logged in to view this page. You can log in <a href='.
	         '"login.php">here</a> or you can sign up <a href="signup.php">here</a></p>'; 
  }	
  
?>
  </div> <!-- END MAIN -->
<?
  require_once('footer.php');
?>
