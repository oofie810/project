<?php	
    class Recipe{
	private $recipeName, $directions, $ingredients;

	public function __construct($recipeName, $directions, $ingredients){
	    $this->setRecipeName($recipeName);
	    $this->setDirections($directions);
	    $this->setIngredients($ingredients);
	}

	public function setRecipeName($str){
	    $this->recipeName = $str;    
	}
	public function getRecipeName(){
	    return $this->recipeName;    
	}
	public function setDirections($str){
	    $this->directions = $str;    
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
	    $sql = 'SELECT recipe.rec_name, recipe.rec_id, ingredients.ingredient, ingredients.ingr_id, rec_ing.amount, rec_ing.units, recipe.directions, units.units FROM recipe INNER JOIN rec_ing ON (rec_ing.rec_id = recipe.rec_id) INNER JOIN ingredients ON (ingredients.ingr_id = rec_ing.ingr_id) INNER JOIN units ON (rec_ing.units = units.id) WHERE recipe.rec_id = :id';

	    $params = array (':id' => $recipeId);

	    $data = Database::getAll($sql, $params);
	    $ingredients_array = array();
	    foreach($data as $ingr){
		$i = new Ingredient($ingr['ingr_id'], $ingr['ingredient'], $ingr['amount'], $ingr['units']);
		$ingredients_array[] = $i;
	    }
	    $recipe = new Recipe($data[0]['rec_name'], $data[0]['directions'], $ingredients_array);
	    return $recipe;
	}
	
	public static function loadAll(){
	    $sql = 'SELECT rec_name, rec_id, directions FROM recipe ORDER BY submission_date DESC';

	    $params = array();
	    $getAll = Database::getAll($sql, $params);
	    return $getAll;
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
	    } 
	    $sql = 'INSERT INTO recipe (rec_name, directions, submitted_by, submission_date) VALUES (:name, :directions, :user, NOW())';
	    $params = array(':name'	   => $recipeName,
			    ':directions'  => $directions,
			    ':user'	   => $userId);
	    $rec_id = Database::insert($sql, $params);
	    self::updateMergeTable($rec_id, $ingredients);
	    LogAction::insertLog($userId, 7);
	    return $rec_id;
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

	    $sql = "INSERT INTO rec_ing (rec_id, ingr_id, amount, units) VALUES " . $questionMarkArray;    
	    
	    Database::bulkInsert($sql, $i);
	
	}
    }

?>
