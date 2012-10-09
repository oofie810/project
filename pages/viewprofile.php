<?php
  $css_files=array('index.css');
  require_once('../lib/appvars.php');
  require_once('header.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');
  require_once('../lib/Ingredient.php');

  if(User::isLoggedIn($_SESSION['username'])){ 

    $username = $_SESSION['username'];
    $user = User::loadUserFromUsername($username);
    $user_id = $user->getUserId();
    echo '<table>';
    echo '<tr><td class="label">Username:</td><td>' .$user->getUsername(). '</td></tr>';
    echo '<tr><td class="label">First Name:</td><td>' .$user->getFirstName(). '</td></tr>';
    echo '<tr><td class="label">Last Name:</td><td>' .$user->getLastName(). '</td></tr>';
    echo '<tr><td class="label">Email:</td><td>' .$user->getEmail(). '</td></tr>';
    echo '<tr><td class="label">Gender:</td><td>' .$user->getGender() .'</td></tr>';
    echo '<tr><td class="label">Birthdate:</td><td>' .$user->getBirthDate().'</td></tr>';
    //TODO check how to do user class with image
    echo '<tr><td class="label">Image:</td><td>img src="' .UP_PATH . $user->getImage() . '" alt="Profile Picture" /></td></tr>';
    echo '</table><br />';
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

  require_once('footer.php');
?>
