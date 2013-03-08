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

    $editrec_id = $_GET['recipe_id'];
    $editrec = Recipe::loadRecipe($editrec_id);
    $edit_id = $editrec->getRecipeId();  
    $editrec_name = $editrec->getRecipeName();
    $editrec_directions = $editrec->getDirections();
    $editrec_ingr = $editrec->getIngredients();
    $editrec_category = $editrec->getCategory();

    $oldIngObj = array();
    //TODO create objects for existing ingredients
    //from there, merge/compare with new ingredient objects
    //foreach($editrec_ingr as $ing){
      //create ingredient with id etc...   
    //}

  if(User::isLoggedIn($_SESSION['username'])){
    
    if (!empty($_POST['submit'])){
      //grab the recipe and ingredients from the submit button
      $recipe_id   = $_POST['recipeId'];
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
        $ingObj = array();
        for($i=0; $i<count($ingredients); $i++){
          $ingObj[] = Ingredient::createIng($ingredients[$i], $amounts[$i], $units[$i]);  
        }
        Recipe::editRecipe($recipe_id, $recipe_name, $directions, $userId, $ingredients, $ingObj, $category);
        if (!empty($pic)){
          Image::saveImageWithCaption($pic, $userId, $caption, $recipe_id);  
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
      <legend>Edit a Recipe</legend>
      <input type="hidden" name="recipeId" id="recipeId" value="<?php echo $edit_id; ?>" /><br />
      <ul id="recipe_input">
        <li><label for="category">Category:</label>
			    <select id="category" name="category" />
			    <?php
				    $query = "SELECT * FROM category";
				    $data = Database::getMultipleRows($query, array());
				    foreach($data as $category){
              $selected = ($category['id']==$editrec_category) ? " selected='selected' " : "";
					    echo "<option $selected value=\"".$category['id']."\">".$category['category']."</option>\n";
				    }
				    ?>
			    </select>
        </li>
			  <li>
          <label for="rec_name"> Recipe Name:</label>
          <input size="70" type ="text" id="rec_name" name="rec_name" value="<?php echo $editrec_name; ?>"
          onblur="validateNonEmpty(this, document.getElementById('rec_help'))"/>
        <span id="rec_help" class="help"></span>	 
      </li>
    </ul>
    <div class="clearboth"></div>
    <ul>
      <li><span class="label">Ingredients:</span>Amount/Measurement/Ingredient</li>
    </ul>
    <ul id="ingredient_input" class="ingredient_input">
      <?php
        foreach ($editrec_ingr as $ingr){
          ?>
          <li>
          <input type="text" size="5" onkeypress="validate(event)" id="amount" name="amount[]" value="<?php echo $ingr->getAmount();?>">
          <select id="unit" name="unit[]" />
            <?php
              $query = "SELECT * FROM unit";
              $data = Database::getMultipleRows($query, array());
                
              foreach($data as $row){
                $select = ($row['name']==$ingr->getUnitName()) ? " selected='selected' " : "";
                echo "<option $select value=\"".$row['id']."\">".$row['name']."</option>\n";
                $units_array[] = $row['name'];
                $id_array[]    = $row['id'];
            //<optionvalue="<?php echo $ingr->getUnitName();
            /*?>"><?php echo $ingr->getUnitName();?></option>
              */
              } ?>
            </select>
            <input size="44" type="text" id="ingredients" name="ingredients[]"/ class="ing" value="<?php echo $ingr->getName();?>"></li>
            <?php
          }
          ?>
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
        <li class="label"><textarea name="directions" rows=20 cols=50 onblur="validateNonEmpty(this, document.getElementById('dir_help'))"><?php echo $editrec_directions; ?></textarea>
          <span id="dir_help" class="help"></span>
        </li>
      </ul>
      <ul id="picture_input" class="ingredient_input">
        <label for="picture">Picture:</label>
        <input type="file" id="picture" name="picture[]" />
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

