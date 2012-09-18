<?php
    session_start();
    $x = 'index';
    require_once('../lib/header.php');
    require_once('../lib/connectvars.php');
    require_once('../lib/Database.php');
    require_once('../lib/Recipe.php');
    
    if(isset($_GET['rec_id'])){

	$id = $_GET['rec_id'];

	$row = Recipe::loadRecipe($id);
	echo '<table>';
	echo '<tr><td>Recipe:</td><td>' . $row->getRecipeName() . '</td></tr>';
	#echo '<tr><td>Ingredients:</td><td>' . $row['amount'] . ' ' . $row['units'] . ' ' . $row['ingredient'] . '</td></td>';
	echo '<tr><td>Directions:</td><td> ' . $row->getDirections() .'</td></tr>';
	echo '</table>';
    
    }

    require_once('../lib/footer.php');
?>

