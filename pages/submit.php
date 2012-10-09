<?php
  $css_files = array('index.css');
  $js_files  = array('scripts.js');
  require_once('header.php');
  require_once('../lib/Recipe.php');
  require_once('../lib/Ingredient.php');

  if(User::isLoggedIn($_SESSION['username'])){

    if (!empty($_POST['submit'])){
      //grab the recipe and ingredients from the submit button
      $recipe_name = $_POST['rec_name'];
      $ingredients = $_POST['ingredients'];
      $directions  = $_POST['directions'];
      $units       = $_POST['unit'];
      $amounts	   = $_POST['amount'];
      
      if (!empty($recipe_name) && !empty($ingredients) && !empty($directions)){
	$user = User::loadUserFromUsername($_SESSION['username']);
        $userId = $user->getUserId();
	Recipe::submitRecipe($recipe_name, $directions, $userId, $ingredients, $amounts, $units);

	$url = '/';
        header('Location: ' . $url);
      } else {
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
        $query = "SELECT * FROM unit";
        $data = Database::getMultipleRows($query, array());
          
        foreach($data as $row){
          echo "<option value=\"".$row['id']."\">".$row['name']."</option>\n";
          $units_array[] = $row['name'];
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
      <li><textarea name="directions" rows = 20 cols = 50 onblur="validateNonEmpty(this, document.getElementById('dir_help'))"></textarea>
        <span id="dir_help" class="help"></span>
      </li>
    </ul>
    <input class="button" type="reset" name="Reset" />
    <input class="button" type="submit" value ="Submit" name="submit" />
  </form>

  <?php
      } else {
          echo '<p>You need to be logged in to submit recipes. You can login<a href="login.php"> here '.
               '</a> or sign up<a href="signup.php"> here</a>';
      }

    require_once('footer.php');
  ?>

