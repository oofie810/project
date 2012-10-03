<?php
    $css_files = array('index.css');
    $js_files = array('scripts.js');
    require_once('../lib/header.php');
    require_once('../lib/connectvars.php');
    require_once('../lib/User.php');
    require_once('../lib/Recipe.php');
    require_once('../lib/Ingredient.php');

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(isset($_SESSION['username'])){

    if (isset($_POST['submit'])){
	//grab the recipe and ingredients from the submit button
	$recipe_name = mysqli_real_escape_string($dbc, trim($_POST['rec_name']));
	$ingredients = $_POST['ingredients'];
	$directions  = mysqli_real_escape_string($dbc, trim($_POST['directions']));
        $unit_id     = $_POST['unit'];
	$amount	     = $_POST['amount'];
	$unit_array = array();
	$id_array = array();
	
	//TODO figure out how to create array of ingredient objects to be sent to
	//submitRecipe. Or should the three arrays be passed and objects will be 
	//created there???
	$salt = new Ingredient(1, 'salt', 3, 3);
	$pepper = new Ingredient(2, 'pepper', 3, 3);
	$bla = new Ingredient(10, 'vfweh', 4, 4);
	if (!empty($recipe_name) && !empty($ingredients) && !empty($directions)){
        
	//build query to insert recipe name, directions and ingredient count to recipe table
	$user = User::loadUserFromUsername($_SESSION['username']);
        $userId = $user->getUserId();
	Recipe::submitRecipe($recipe_name, $directions, $userId, array($salt, $pepper, $bla));

	$url = '/';
	header('Location: ' . $url);
	}
     else {
	 echo '<p class="error">Please provide all the needed information.</p>';
	 
	} 
    }

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    	<ul id="recipe_input">
	    <li>Recipe:</li>
	    <li><input size="70" type ="text" id ="rec_name" name="rec_name"
		 onblur="validateNonEmpty(this, document.getElementById('rec_help'))">
		 <span id="rec_help" class="help"></span>	 
	    </li>
	</ul>
	<ul id="ingredient_input">
	<li>Ingredients:</li>
	<li><input type="text" size="5" onkeypress="validate(event)" id="amount" name="amount[]">
	    <select id="unit" name="unit[]" />
	   
		<?php
		    $query = "SELECT * FROM units";
		    $dataSelect = mysqli_query($dbc, $query);
		    
		    while($row=mysqli_fetch_array($dataSelect)){
			echo "<option value=\"".$row['id']."\">".$row['units']."</option>\n";
			$units_array[] = $row['units'];
			$id_array[]    = $row['id'];
		?>
		    <script type='text/javascript'>
		    <?php
			$js_array = json_encode($units_array);
			$js_id_array = json_encode($id_array);
			echo "var javascript_array = " . $js_array . ";\n";
			echo "var javascript_array2= " . $js_id_array . ";\n";
		    ?> 
			</script>
		    <?php
		     }	
		    ?>

	        <input size="44" type="text" id="ingredients" name="ingredients[]"/></li>
         </ul>
	 <ul>
	     <li><button type="button" name="button" onClick="newRow('ingredient_input', javascript_array, javascript_array2);">+</li>
	 </ul>
	 <ul id="directions_input">
	    <li>Directions:</li>
	    <li><textarea name="directions" rows = 20 cols = 50 onblur="validateNonEmpty(this,
		 document.getElementById('dir_help'))"></textarea>
		<span id="dir_help" class="help"></span>
	    </li>
	</ul>
	<input class="button" type="reset" name="Reset" />
	<input class="button" type="submit" value ="Submit" name="submit" />
</form>


<?php
    }
else {
    echo '<p>You need to be logged in to submit recipes. You can login<a href="login.php"> here</a>'.
         ' or sign up<a href="signup.php"> here</a>';
    }

require_once('../lib/footer.php');
?>

