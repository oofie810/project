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
<?php
  if(User::isLoggedIn()){
    $user_id = $_GET['user_id'];
    echo "Submmited Recipes:";
    $recipes_submitted = Recipe::loadRecipeByUser($user_id);
    foreach($recipes_submitted as $recipe){
      echo '<ul>';
      echo '<li><a href="editsubmit.php?recipe_id=' . $recipe->getRecipeId() . '">' .$recipe->getRecipeName() . ' </a></li>';
      echo '<li>' . substr($recipe->getDirections(), 0, 100) . '... </li>';
      echo '</ul>';
    }
  }

?>
