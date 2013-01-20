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
      echo '<h4>' . $recipe->getRecipeName() . '</h4>';
      echo '<div id ="ing">';
      echo '<p>Ingredients:</p>';
        echo '<ul>';
        foreach($recipe->getIngredients() as $ingr){
	  			echo '<li>' . $ingr->getAmount() . ' ' . $ingr->getUnitName() . ' ' . $ingr->getName() . '</li>';
				}		
      	echo '</ul>';
      echo '</div>';
      echo '<div id="directions">';
      echo '<p class="directions">Directions:</p><p> ' . $recipe->getDirections() . '</p>';
      echo '</div>';
			echo '</div>';
			echo '<br />';
    }
/*    $picArray = Image::loadImagesByRecipeId($recipeId);
    foreach($picArray as $pic){
    ?>
      <div id="galleria">
    <?php
      echo '<img src="' . UP_PATH . $pic->getFilename() . '" />';
      }
    ?> 
      </div>
  <script>
    Galleria.loadTheme('scripts/galleria/themes/classic/galleria.classic.min.js');
    Galleria.run('#galleria');
  </script>
*/
//<?php
  require_once('footer.php');
?>

