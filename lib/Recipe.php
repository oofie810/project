<?php	
	require_once('Ingredient.php');
  class Recipe{
    private $recipeId, $recipeName, $directions, $ingredients, $category;

    public function __construct($recipeId, $recipeName, $directions, $ingredients, $category){
      $this->setRecipeId($recipeId);
      $this->setRecipeName($recipeName);
      $this->setDirections($directions);
      $this->setIngredients($ingredients);
			$this->setCategory($category);
    }

    public function setRecipeName($recipeName){
      $this->recipeName = $recipeName;    
    }
    public function getRecipeName(){
      return $this->recipeName;    
    }
    public function setDirections($directions){
      $this->directions = $directions;    
    }
    public function getDirections(){
      return $this->directions;    
    }
    public function setIngredients($ingredients){
      $this->ingredients = $ingredients;    
    }
    public function getIngredients(){
      return $this->ingredients;    
    }
    public function setRecipeId($recipeId){
      $this->recipeId = $recipeId;  
    }
    public function getRecipeId(){
      return $this-> recipeId;  
    }
		public function setCategory($category){
			$this->category = $category;	
		}
		public function getCategory(){
			return $this-> category;
		}

    public static function loadRecipe($recipeId){
      $sql = "SELECT * FROM recipe WHERE id = :id";
      $params = array (':id' => $recipeId);
      $recipe_result = Database::getRow($sql, $params, 'recipe:' . $recipeId);
      $ingredients_result = Ingredient::loadRecipeIngredients($recipeId);
      return new Recipe($recipe_result['id'], $recipe_result['name'], $recipe_result['directions'], $ingredients_result, $recipe_result['category']);
    }

		//function returns a random object from array of objects. 
    public static function loadRecipeUseCat($category){
      $sql = "SELECT * FROM recipe WHERE category = :category";
      $params = array (':category' => $category);
      $recipe_result = Database::getMultipleRows($sql, $params, 'recipe:'. $category);
			$random = array_rand($recipe_result);
      $ingredients_result = Ingredient::loadRecipeIngredients($recipe_result[$random]['id']);
      return new Recipe($recipe_result[$random]['id'], $recipe_result[$random]['name'], $recipe_result[$random]['directions'], $ingredients_result, $recipe_result[$random]['category']);
    }

    public static function loadRecipeByUser($userId){
      $sql = "SELECT name, id, directions, category FROM recipe WHERE submitted_by = :userId";
      $params = array (':userId' => $userId);
      $results = Database::getMultipleRows($sql, $params, 'recipe:'. $userId);
      $recipes = array();
      foreach($results as $recipe){
        $ingredients = Ingredient::loadRecipeIngredients($recipe['id']);
        $recipes[] = new Recipe($recipe['id'], $recipe['name'], $recipe['directions'], $ingredients, $recipe['category']);
      }
      return $recipes;
    }
	
    public static function recipeSearch($name){
      $sql = "SELECT name, id, directions, category FROM recipe WHERE name LIKE :name";
      $params = array (':name' => '%' . $name . '%');
      $results = Database::getMultipleRows($sql, $params, 'recipe:' . $name);
      $recipes = array();
      foreach($results as $recipe){
        $ingredients = Ingredient::loadRecipeIngredients($recipe['id']);
        $recipes[] = new Recipe($recipe['id'], $recipe['name'], $recipe['directions'], $ingredients, $recipe['category']);
      }
      return $recipes;
    }

    public static function lazyLoadRecipes(){
      $sql = 'SELECT name, id, directions FROM recipe ORDER BY submission_date DESC';
      $recipes = Database::getMultipleRows($sql, array(), 'allrecipes');
      return $recipes;
    }

    public static function submitRecipe($recipeName, $directions, $userId, $ingredient_names, $ingObj, $category){
      $ingredient_in_database = Ingredient::loadMultipleIngredientNames($ingredient_names);
      // insert missing ingredients
      $ing = array();
      foreach($ingredient_in_database as $k => $v){
        $ing[$k] = $v['name'];
      }
      $missing_ingredient_names = array_diff($ingredient_names, $ing);
      if(!empty($missing_ingredient_names)){
        Ingredient::insertMultipleIngredients($missing_ingredient_names); 
      }

      $sql ="INSERT INTO recipe (name, directions, submitted_by, submission_date, category) VALUES (:name, :directions, :user, NOW(), :category)";
      $params = array(':name'	=> $recipeName, ':directions' => $directions, ':user'	=> $userId, ':category' => $category);
      $recipe_id = Database::insert($sql, $params);

      Ingredient::associateIngredientsToRecipe($recipe_id, $ingredient_names, $ingObj);
      LogAction::insertLog($userId, 7);
      return $recipe_id;
    
    }

    public static function editRecipe($recipeId, $recipeName, $directions, $userId, $ingredient_names, $amounts, $units, $category){
      $ingredient_in_database = Ingredient::loadMultipleIngredientNames($ingredient_names);
      // insert missing ingredients
      $ing = array();
      foreach($ingredient_in_database as $k => $v){
        $ing[$k] = $v['name'];
      }
      $missing_ingredient_names = array_diff($ingredient_names, $ing);
      error_log("missing ingredients");
      error_log(print_r($missing_ingredient_names, true)); 
      if(!empty($missing_ingredient_names)){
        Ingredient::insertMultipleIngredients($missing_ingredient_names); 
      }

      $sql ="UPDATE recipe SET name = :name, directions = :directions, submission_date = NOW(), category = :category WHERE id = :id";
      $params = array(':name'	=> $recipeName, ':directions' => $directions, ':id' => $recipeId, ':category' => $category);
      Database::update($sql, $params);

      Ingredient::associateIngredientsToRecipe($recipeId, $ingredient_names, $amounts, $units);
      //TODO add additional log action - edit recipe
      LogAction::insertLog($userId, 7);
      return $recipeId;
    
    }

}

?>
