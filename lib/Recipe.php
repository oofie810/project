<?php	
  class Recipe{
    private $recipeId, $recipeName, $directions, $ingredients;

    public function __construct($recipeId, $recipeName, $directions, $ingredients){
      $this->setRecipeId($recipeId);
      $this->setRecipeName($recipeName);
      $this->setDirections($directions);
      $this->setIngredients($ingredients);
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

    public static function loadRecipe($recipeId){
      $sql = "SELECT * FROM recipe WHERE id = :id";
      $params = array (':id' => $recipeId);
      $recipe_result = Database::getRow($sql, $params);
      $ingredients_result = Ingredient::loadRecipeIngredients($recipeId);
      return new Recipe($recipe_result['id'], $recipe_result['name'], $recipe_result['directions'], $ingredients_result);
    }

    public static function loadRecipeByUser($userId){
      $sql = "SELECT name, id, directions FROM recipe WHERE submitted_by = :userId";
      $params = array (':userId' => $userId);
      $results = Database::getMultipleRows($sql, $params);
      $recipes = array();
      foreach($results as $recipe){
        $ingredients = Ingredient::loadRecipeIngredients($recipe['id']);
        $recipes[] = new Recipe($recipe['id'], $recipe['name'], $recipe['directions'], $ingredients);
      }
      return $recipes;
    }
	
    public static function recipeSearch($name){
      $sql = "SELECT name, id, directions FROM recipe WHERE name = :name";
      $params = array (':name' => $name);
      $results = Database::getMultipleRows($sql, $params);
      $recipes = array();
      foreach($results as $recipe){
        $ingredients = Ingredient::loadRecipeIngredients($recipe['id']);
        $recipes[] = new Recipe($recipe['id'], $recipe['name'], $recipe['directions'], $ingredients);
      }
      return $recipes;
    }

    public static function lazyLoadRecipes(){
      $sql = 'SELECT name, id, directions FROM recipe ORDER BY submission_date DESC';
      $recipes = Database::getMultipleRows($sql, array());
      return $recipes;
    }

    public static function submitRecipe($recipeName, $directions, $userId, $ingredient_names, $amounts, $units){
      $ingredient_names_found = Ingredient::loadMultipleIngredientNames($ingredient_names);

      // insert missing ingredients
      $missing_ingredient_names = array_diff($ingredient_names, $ingredient_names_found);
      if(!empty($missing_ingredient_names)){
        Ingredient::insertMultipleIngredients($missing_ingredient_names); 
      }

      $sql ="INSERT INTO recipe (name, directions, submitted_by, submission_date) VALUES (:name, :directions, :user, NOW())";
      $params = array(':name'	=> $recipeName, ':directions' => $directions, ':user'	=> $userId);
      $recipe_id = Database::insert($sql, $params);

      Ingredient::associateIngredientsToRecipe($recipe_id, $ingredient_names, $amounts, $units);
      LogAction::insertLog($userId, 7);
      return $recipe_id;
    }
  
}

?>
