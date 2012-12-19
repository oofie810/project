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
        echo '<li><a href="viewrecipe.php?recipe_id='. $recipe->getRecipeId() . '">'.$recipe->getRecipeName().'</a></li>';
        echo '</li>' .substr($recipe->getDirections(), 0, 230) . '...</li>';
        if($image != null){
          echo '</li><img src ="' . DISP . $image->getFilename() . '" /></li><br />';
        }
        echo '</ul>';

      }
    }
    else{
      echo '<p>Sorry, no recipes were found.</p>';  
    }
  }

?>
