<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/appvars.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');
  require_once('../lib/Ingredient.php');
  require_once('../lib/Image.php');


  if(isset($_GET['recipe_id'])){

    $recipeId = $_GET['recipe_id'];
    $recipe = Recipe::loadRecipe($recipeId);
    echo '<div id = "recipe">';
    echo '<h1>' . $recipe->getRecipeName() . '</h1>';
    
    $picArray = Image::loadImagesByRecipeId($recipeId);
    if(!empty($picArray)){
?>
      <div id="galleria">
      <?php
      foreach($picArray as $pic){
        echo '<img src="' . Config::getAwsFolder() . '800x600_' . $pic->getFilename() . '" />';
      }
      ?> 
      </div><!--end div galleria!-->
      <script>
        Galleria.loadTheme('scripts/galleria/themes/classic/galleria.classic.min.js');
        Galleria.run('#galleria');
      </script>

<?php
    }
      echo '<h3>Ingredients:</h3>';
        echo '<ul>';
        foreach($recipe->getIngredients() as $ingr){
	  			echo '<li>' . $ingr->getAmount() . ' ' . $ingr->getUnitName() . ' ' . $ingr->getName() . '</li>';
				}		
      	echo '</ul>';
      echo '<h3>Directions:</h3>';
      echo '<p id="directions">' . nl2br($recipe->getDirections()) . '</p>';
			echo '</div>'; //end div recipe
  }
  require_once('footer.php');
?>

