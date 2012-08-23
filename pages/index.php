<?php
  $x = 'index';
  session_start(); 
  require_once('../lib/header.php');
  require_once('../lib/connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if(isset($_SESSION['username'])){
    echo '<p>You are logged in as ' .$_SESSION['username']. '</p>';
    echo '<p>You can submit recipes using this <a href="submit.php">link</a></p>';
    echo '<p>You can edit your profile <a href="editprofile.php">here</a></p>';
    echo '<p>You can edit your user settings <a href="usersettings.php">here</a></p>';
    echo $_SERVER['REMOTE_ADDR'];
   }

    
    //display recipes submitted
    $query = "SELECT rec_name, rec_id, directions FROM recipe ORDER BY submission_date DESC";

    $data =mysqli_query($dbc, $query) or die ('error ln 29: '.mysqli_error($dbc));
    
    
    echo '<h4>Latest Recipes:</h4>';
    while ($row = mysqli_fetch_array($data)){
	if(isset($_SESSION['username'])){
	    $recipeId = $row['rec_id'];
	    echo '<ul>';
		echo '<li><a href="viewrecipe.php?rec_id=' . $row['rec_id'] . '">'.$row['rec_name'].'</a></li>';
		    $query2 = "SELECT ingredients.ingredient, rec_ing.amount, rec_ing.units, units.units FROM rec_ing INNER JOIN ingredients ON (rec_ing.ingr_id = ingredients.ingr_id) INNER JOIN units ON (rec_ing.units = units.id) WHERE rec_ing.rec_id = '" .$recipeId . "'";
		    $data2 = mysqli_query($dbc, $query2);
		    
		    while($row2 = mysqli_fetch_array($data2)){
		    echo '<li>' .$row2['ingredient'] .'</li>';
		    }
		echo '<li>' . substr($row['directions'], 0, 240) .'...</li><br />';
	    echo '</ul>';
	    }
	  else{  
	    echo '<h4>' . $row['rec_name']. '</h4>';
	    echo '<p>' . $row['ingredient'] .'</p>';
	    echo '<p>' . substr($row['directions'], 0, 240) . '...</p><br />'; 
	    }
       }

require_once('../lib/footer.php');
?>

