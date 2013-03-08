<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');
  require_once('../lib/Ingredient.php');
  require_once('../lib/Image.php');
  require_once('../lib/appvars.php');

  if(isset($_GET['category'])){
    $category = $_GET['category'];

    $query = "SELECT * FROM category WHERE id = :category";
    $params = array(':category' => $category);
    $data = Database::getRow($query, $params);
    echo '<h2 id="categoryHead">' . $data['category'] . 's' . '</h2>';
  
    $data = Recipe::loadAllRecipeInCat($category);
    if($data != null){
      foreach ($data as $recipe){
        $res = 1;
        $image = Image::loadImageForSearchRecipe($recipe->getRecipeId(), $res);
        echo '<ul id="searchResults">';
        if($image != null){
          echo '<a href="viewrecipe.php?recipe_id=' . $recipe->getRecipeId() . '"><img src ="' . Config::getAwsFolder() . '150x100_' . $image->getFilename() . '" /></a>';
        }
        echo '<li><h4><a href="viewrecipe.php?recipe_id='. $recipe->getRecipeId() . '">'.$recipe->getRecipeName().'</a></h4>';
        echo substr($recipe->getDirections(), 0, 150) . '...</li>';
        echo '</ul>';

      }
    }
    else{
      echo '<p>Sorry, no recipes were found.</p>';  
    }
  }

?>
