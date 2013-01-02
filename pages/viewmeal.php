<?php
	$css_files = array('index.css');
	require_once('header.php');
	require_once('../lib/Database.php');
	require_once('../lib/Recipe.php');
	require_once('../lib/Ingredient.php');

	if (isset($_POST['meal'])){
		$i = $_POST['meal'];

		echo '<h2>You chose: </h2><br />';
		switch($i){
			case 4:
				echo "Appetizer";
				$appetizer = Recipe::loadRecipeUseCat(1);
				Recipe::displayRecipe($appetizer);
			case 3:
				echo "Desert";
				$desert = Recipe::loadRecipeUseCat(2);
				Recipe::displayRecipe($desert);
			case 2:
				echo "Side Dish";
				$side = Recipe::loadRecipeUseCat(4);
				Recipe::displayRecipe($side);
			case 1:
				echo "Main Course";
				$main = Recipe::loadRecipeUseCat(5);
				Recipe::displayRecipe($main);
		}
	}

?>
