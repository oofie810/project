<?php
    session_start();
    $x = 'index';
    require_once('../lib/header.php');
    require_once('../lib/connectvars.php');
    
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(isset($_GET['rec_id'])){
    //$query = "SELECT rec_id, rec_name, directions FROM recipe WHERE rec_id = '". $_GET['rec_id'] ."'";
    $query = "SELECT recipe.rec_name, recipe.rec_id, ingredients.ingredient, rec_ing.amount, rec_ing.units, recipe.directions, units.units FROM recipe INNER JOIN rec_ing ON (rec_ing.rec_id = recipe.rec_id) INNER JOIN ingredients ON (ingredients.ingr_id = rec_ing.ingr_id) INNER JOIN units ON (rec_ing.units = units.id) WHERE recipe.rec_id = '". $_GET['rec_id'] . "'";

    $data = mysqli_query ($dbc, $query) or die('error ln 11:'.mysqli_error($dbc));

    $row = mysqli_fetch_array($data);
    $count = count($row['ingredient']);
    echo $count;
    echo $row['rec_name'];
    echo '<table>';
    echo '<tr><td>Recipe:</td><td>' . $row['rec_name'] . '</td></tr>';
    echo '<tr><td>Ingredients:</td><td>' . $row['amount'] . ' ' . $row['units'] . ' ' . $row['ingredient'] . '</td></td>';
    echo '<tr><td>Directions:</td><td> ' . $row['directions'] .'</td></tr>';
    echo '</table>';
    
    }
    require_once('../lib/footer.php');
?>

