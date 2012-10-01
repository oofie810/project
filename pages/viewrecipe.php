<?php
    $css_files = array('index.css');
    require_once('../lib/header.php');
    require_once('../lib/connectvars.php');
    require_once('../lib/Database.php');
    require_once('../lib/Recipe.php');
    require_once('../lib/Ingredient.php');

    if(isset($_GET['rec_id'])){

	$id = $_GET['rec_id'];

	$row = Recipe::loadRecipe($id);
	$ingr = Ingredient::loadAllIngr($id);
	echo '<table>';
	echo '<tr><td>Recipe:</td><td>' . $row->getRecipeName() . '</td></tr>';
	echo '<tr><td>Ingredients:</td><td>'; 
	foreach($ingr as $key=>$ingr){
	    echo $ingr->getAmount() . ' ' . $ingr->getUnit() . ' ' . $ingr->getIngredient() . '<br />';    
	}
	echo '<tr><td>Directions:</td><td> ' . $row->getDirections() .'</td></tr>';
	echo '</table>';
    
    }

    require_once('../lib/footer.php');
?>

