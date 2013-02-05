<?php
  $css_files = array('index.css');
  $js_files  = array('scripts.js');
  require_once('header.php');
  require_once('../lib/Recipe.php');
  require_once('../lib/Ingredient.php');
  require_once('../lib/Image.php');
  
  include_once('sidebar.php');
?>
  <div id="main">
<?php
  if(User::isLoggedIn($_SESSION['username'])){

    if (!empty($_POST['submit'])){
      //grab the recipe and ingredients from the submit button
      $recipe_name = $_POST['rec_name'];
      $ingredients = $_POST['ingredients'];
      $directions  = $_POST['directions'];
      $units       = $_POST['unit'];
      $amounts	   = $_POST['amount'];
      $category 	 = $_POST['category'];
      $pic         = $_FILES['picture']['name'];
      $caption     = $_POST['caption'];

      if (!empty($recipe_name) && !empty($ingredients) && !empty($directions)){
	      $user = User::loadUserFromUsername($_SESSION['username']);
        $userId = $user->getUserId();
	      Recipe::submitRecipe($recipe_name, $directions, $userId, $ingredients, $amounts, $units, $category);
        if (!empty($pic)){
          Image::saveImageWithCaption($pic, $id, $caption, 1);  
        }
	      $url = '/';
        header('Location: ' . $url);
      } else {
          echo '<p class="error">Please provide all the needed information.</p>';
      }
    }
      
?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="genericform" id="recipeform">
    <fieldset>
      <legend>Submit a Recipe</legend>
      <ul id="recipe_input">
        <li><label for="category">Category:</label>
			    <select id="category" name="category" />
			    <?php
				    $query = "SELECT * FROM category";
				    $data = Database::getMultipleRows($query, array());
				    foreach($data as $category){
					    echo "<option value=\"".$category['id']."\">".$category['category']."</option>\n";
				    }
				    ?>
			    </select>
        </li>
			  <li>
          <label for="rec_name"> Recipe Name:</label>
          <input size="70" type ="text" id ="rec_name" name="rec_name"
        onblur="validateNonEmpty(this, document.getElementById('rec_help'))">
        <span id="rec_help" class="help"></span>	 
      </li>
    </ul>
    <div class="clearboth"></div>
    <ul>
      <li><span class="label">Ingredients:</span>Amount/Measurement/Ingredient</li>
    </ul>
    <ul id="ingredient_input" class="ingredient_input">
      <li>
        <input type="text" size="5" onkeypress="validate(event)" id="amount" name="amount[]">
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
      </select>
      <input size="44" type="text" id="ingredients" name="ingredients[]"/ class="ing"></li>
    </ul>
    <ul class="addmore">
      <li><button type="button" name="button" onClick="newRow('ingredient_input', javascript_array, javascript_array2);" class="newing">+ Add Ingredient</li>
    </ul>
    <ul id="directions_input">
      <li><label for="directions">Directions:</span></li>
      <li class="label"><textarea name="directions" rows = 20 cols = 50 onblur="validateNonEmpty(this, document.getElementById('dir_help'))"></textarea>
        <span id="dir_help" class="help"></span>
      </li>
    </ul>
    <ul id="picture_input">
      <li><label for="picture">Picture:</label>
      <input type="file" id="picture" name="picture[]" />
      <label for="caption">Caption:</label>
      <input type="text" id="caption" name="caption[]" /></li>
     </ul>
     <ul class="addmore">
     <li><button type="button" name="button" onClick="newRowForImages('picture_input');">+ Add Photo</li>
     </ul>
    <input class="button" type="reset" name="Reset" />
    <input type="submit" value ="Submit" name="submit" />
    </form>
  </form>
  </div> <!-- END MAIN -->
  <?php
      } else {
          echo '<p>You need to be logged in to submit recipes. You can login<a href="login.php"> here '.
               '</a> or sign up<a href="signup.php"> here</a>';
      }
    require_once('footer.php');
  ?>

