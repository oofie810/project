<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');
  require_once('../lib/Ingredient.php');
  require_once('../lib/Image.php');
  require_once('../lib/appvars.php');

  if(isset($_GET['search_box'])){
    $search = $_GET['search_box'];
  
    $data = Recipe::recipeSearch($search);
    if($data != null){
      foreach ($data as $recipe){
        $res = 1;
        $image = Image::loadImageForSearchRecipe($recipe->getRecipeId(), $res);
        echo '<ul id="searchResults">';
        if($image != null){
          echo '<img src ="' . Config::getAwsFolder() . '150x100_' . $image->getFilename() . '" />';
        }
        echo '<li><h4><a href="viewrecipe.php?recipe_id='. $recipe->getRecipeId() . '">'.$recipe->getRecipeName().'</a></h4>';
        echo substr($recipe->getDirections(), 0, 150) . '...';
        echo '</ul>';

      }
    }
    else{
      echo '<p>Sorry, no recipes were found.</p>';  
    }
  }

?>
