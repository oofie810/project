<?php
    $css_files = array('index.css');
    require_once('../lib/header.php');
    require_once('../lib/Database.php');
    require_once('../lib/Recipe.php');
    require_once('../lib/Ingredient.php');

    if(isset($_GET['recipe_id'])){

	$recipeId = $_GET['recipe_id'];

	$recipe = Recipe::loadRecipe($recipeId);
	echo '<table>';
	echo '<tr><td>Recipe:</td><td>' . $recipe->getRecipeName() . '</td></tr>';
	echo '<tr><td>Ingredients:</td><td>'; 
	foreach($recipe->getIngredients() as $ingr){
	    echo $ingr->getAmount() . ' ' . $ingr->getUnit() . ' ' . $ingr->getIngredient() . '<br />';    
	}
	echo '<tr><td>Directions:</td><td> ' . $recipe->getDirections() .'</td></tr>';
	echo '</table>';
    
    }

    require_once('../lib/footer.php');
?>

