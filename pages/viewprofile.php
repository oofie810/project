<?php
    //edited 9/3/12 using user object
    $css_files=array('index.css');
    require_once('../lib/connectvars.php');
    require_once('../lib/appvars.php');
    require_once('../lib/header.php');
    require_once('../lib/Database.php');
    require_once('../lib/User.php');

    if(isset($_SESSION['username'])){ 

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('Error ln 7:'.mysqli_error($dbc));

	$id = $_SESSION['username'];

	$row = User::load($id);
	echo '<table>';
	$user_id = $row->getUserId();
	echo '<tr><td class="label">Username:</td><td>' .$row->getUsername(). '</td></tr>';
	echo '<tr><td class="label">First Name:</td><td>' .$row->getFirstName(). '</td></tr>';
	echo '<tr><td class="label">Last Name:</td><td>' .$row->getLastName(). '</td></tr>';
	echo '<tr><td class="label">Email:</td><td>' .$row->getEmail(). '</td></tr>';
	echo '<tr><td class="label">Gender:</td><td>' .$row->getGender() .'</td></tr>';
	echo '<tr><td class="label">Birthdate:</td><td>' .$row->getBirthDate().'</td></tr>';
	//TODO check how to do user class with image
	echo '<tr><td class="label">Image:</td><td>img src="' .UP_PATH . $row->getImage() . '" alt="Profile Picture" /></td></tr>';
	#echo '<tr><td class="label">Image:</td><td><img src="' . UP_PATH . $row['image'] . '" alt="Profile Picture" /></td></tr>';
	echo '</table><br />';
	echo '<table>';

	//get recipes that the user submitted    
	$query = "SELECT rec_name, rec_id, directions FROM recipe WHERE submitted_by = '" .$user_id . "'";

	$data = mysqli_query($dbc, $query) or die('error ln 45:'.mysqli_error($dbc));

	echo '<h5>Recipes that you submitted:</h3>';
	while($row = mysqli_fetch_array($data)){
	    $recipeId = $row['rec_id'];
	    echo '<ul>';
	    echo '<li><h4>Recipe Name:</h4> '.$row['rec_name'] . '</li>' ;
	    echo '<li><h4>Ingredients:</h4></li>';
	    $query2 = "SELECT ingredients.ingredient, rec_ing.amount, rec_ing.units, units.units FROM rec_ing INNER JOIN ingredients ON (rec_ing.ingr_id = ingredients.ingr_id) INNER JOIN units ON (rec_ing.units = units.id) WHERE rec_ing.rec_id = '" .$recipeId . "'";
	    $data2 = mysqli_query($dbc, $query2) or die ('erro ln 55:'.mysqli_error($dbc));
	    while ($row2 = mysqli_fetch_array($data2)){
		echo '<li>'.$row2['amount'] . ' '.$row2['units'] .' '.$row2['ingredient'] . '</li>';
	    }
	    echo '<li><h4>Directions:</h4></li>';
	    echo '<li>' . $row['directions'] . '</li>';
	    echo '</ul>';

	}
    mysqli_close($dbc);
    }
    else{
	echo '<p class="error">You must be logged in to view this page. You can log in <a href='.
	'"login.php">here</a> or you can sign up <a href="signup.php">here</a></p>'; 
    }	

    require_once('../lib/footer.php');
?>
