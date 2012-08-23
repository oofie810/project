<?php
    $x = 'index';
    $y = 'js';
    session_start();
    require_once('../lib/header.php');
    require_once('../lib/connectvars.php');
    require_once('../lib/functions.php');

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
	
	if (!empty($recipe_name) && !empty($ingredients) && !empty($directions)){
//	$clean = preg_replace('/[\r\n | \r | \n | \n\r]/', ' ', $ingredients);
        
	//build query to insert recipe name, directions and ingredient count to recipe table
        $user_id = get_user_id_from_username($_SESSION['username']);
	$query = "INSERT INTO recipe (rec_name, directions, submitted_by, submission_date) VALUES ('$recipe_name', '$directions','$user_id', NOW())";
	$connect = mysqli_query($dbc, $query) or die('error ln 40: '.mysqli_error($dbc));
	
	//log the recipe submission - action 7 
	if ($connect){
	    $ip = $_SERVER['REMOTE_ADDR'];
	    logaction($_SESSION['username'], 7, $ip);
	    }
	//get recipe id for insertion to rec_ing table with ingredients
	$query = "SELECT rec_id FROM recipe WHERE rec_name = '$recipe_name'";
	$data = mysqli_query($dbc, $query) or die('error ln 42: '.mysqli_error($dbc));
	$row = mysqli_fetch_array ($data);
	$rec_id = $row['rec_id'];
	
	//insert ingredients to ingredients table
	$length = count($ingredients);
	for($i=0; $i < $length; $i++){
	    $ingr = $ingredients[$i];
	    $ingr = trim($ingr);
	    $amt = $amount[$i];
	    $unit = $unit_id[$i]; 

	    //check to see if ingredient is in the ingredients table already
	    $query = "SELECT ingr_id FROM ingredients WHERE ingredient = '$ingr'";
	    $data = mysqli_query ($dbc, $query) or die ('error ln 51:'.mysqli_error($dbc));
	    
	    //if it doesnt exist in table, insert ingredient. 
	    if (mysqli_num_rows($data) == 0){
		$query = "INSERT INTO ingredients (ingredient) VALUES ('$ingr')";
		mysqli_query ($dbc, $query) or die ('error ln 53:'.mysqli_error($dbc));
    
		//get ingredient id after inserting. 
		$query = "SELECT ingr_id FROM ingredients WHERE ingredient = '$ingr'";
		$data2 = mysqli_query ($dbc, $query) or die ('error ln 57: '.mysqli_error($dbc));
		$row = mysqli_fetch_array ($data2);
		$ingr_id = $row['ingr_id'];

		//insert into rec_ing table together with rec_id, ingr_id and amount
		$query = "INSERT INTO rec_ing (rec_id, ingr_id, amount, units) VALUES ($rec_id, $ingr_id, '$amt', $unit)";
		mysqli_query ($dbc, $query) or die ('error ln 63: '.mysqli_error($dbc));
		}
	    else{
		//get ingr_id for ingredient and insert into rec_ing. no need to insert into ingredient
		//table since ingredient exists already
		$row = mysqli_fetch_array($data);
		$ingr_id = $row['ingr_id'];

		//since ingredient exists already, just add them to the rec_ing table
		$query = "INSERT INTO rec_ing (rec_id, ingr_id, amount, units) VALUES ($rec_id, $ingr_id, '$amt', $unit)";
		mysqli_query($dbc, $query) or die ('error ln 71: '.mysqli_error($dbc));

	    }
	  }
	mysqli_close($dbc);
	$url = 'http://192.168.1.103/index.php';
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

