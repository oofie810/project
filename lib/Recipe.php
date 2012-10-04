<?php	
    class Recipe{
	private $recipeName, $directions, $ingredients;

	public function __construct($recipeName, $directions, $ingredients){
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

	public static function loadRecipe($recipeId){
	    $sql = 'SELECT recipe.name as recipe_name, recipe.id, ingredient.name as ingredient_name, recipe_to_ingredient.amount, recipe_to_ingredient.unit_id, recipe.directions, unit.name as unit_name FROM recipe INNER JOIN recipe_to_ingredient ON (recipe_to_ingredient.recipe_id = recipe.id) INNER JOIN ingredient ON (ingredient.id = recipe_to_ingredient.ingredient_id) INNER JOIN unit ON (recipe_to_ingredient.unit_id = unit.id) WHERE recipe.id = :id';


	    $params = array (':id' => $recipeId);

	    $data = Database::getMultipleRows($sql, $params);
	    error_log(print_r($data, true));
	    $ingredients_array = array();
	    foreach($data as $ingr){
		$i = new Ingredient($ingr['id'], $ingr['ingredient_name'], $ingr['amount'], $ingr['unit_name']);
		$ingredients_array[] = $i;
	    }
	    $recipe = new Recipe($data[0]['recipe_name'], $data[0]['directions'], $ingredients_array);
	    return $recipe;
	}
	
	public static function lazyLoadRecipes(){
	    $sql = 'SELECT name, id, directions FROM recipe ORDER BY submission_date DESC';
	    $recipes = Database::getMultipleRows($sql, array());
	    return $recipes;
	}

	public static function submitRecipe($recipeName, $directions, $userId, $ingredients){
	    $ing = array();
	    foreach($ingredients as $ingredient){
		$ing[] = $ingredient->getIngredient();
	    }
	    $ingredient_found = Ingredient::loadIngredientsByName($ing);
	    if (empty($ingredient_found)){
		Ingredient::insertMultipleIngredients($ingredients);	
		$ingredient_found = Ingredient::loadIngredientsByName($ing);
	    } else if(count($ingredients) > count($ingredient_found)){
		$s = array();
		$f = array();
		foreach($ingredients as $ingre){
		    $s[] = $ingre->getIngredient();
		} 
		foreach($ingredient_found as $ingre){
		    $f[] = $ingre->getIngredient();    
		} 
		$n = array_diff($s, $f);
		$p = array();
		foreach($n as $i){
		    $p[] = new Ingredient(0, $i, null, null); 
		}
		Ingredient::insertMultipleIngredients($p);
		//TODO can be total_ingredients? Should be passed to updateMergetable? 
		//or should this be called again? purpose?
		$ingredient_found = Ingredient::loadIngredientsByName($ing);
	    } 
	    $sql = 'INSERT INTO recipe (name, directions, submitted_by, submission_date) VALUES (:name, :directions, :user, NOW())';
	    $params = array(':name'	   => $recipeName,
			    ':directions'  => $directions,
			    ':user'	   => $userId);
	    $recipe_id = Database::insert($sql, $params);
	    self::updateMergeTable($recipe_id, $ingredients);
	    #LogAction::insertLog($userId, 7);
	    return $recipe_id;
	}
	
	private static function updateMergeTable($recipeId, $ingredients){
	    $questionMarkArray = '';
	    $i = array();
	    foreach($ingredients as $ingredient){
		$i[] = $recipeId;
		$i[] = $ingredient->getIngrId();
		$i[] = $ingredient->getAmount();
		$i[] = $ingredient->getUnit();
		$questionMarkArray .= '(?, ?, ?, ?),';
	    }
	    $questionMarkArray = trim($questionMarkArray, ',');

	    $sql = "INSERT INTO recipe_to_ingredient (recipe_id, ingredient_id, amount, unit_id) VALUES " . $questionMarkArray;    
	    
	    Database::bulkInsert($sql, $i);
	
	}
    }

?>
