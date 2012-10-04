<?php
    class Ingredient{
	private $ingr_id, $ingredient, $amount, $unit;

	public function __construct($ingr_id, $ingredient, $amount, $unit){
	    $this->setIngrId($ingr_id);
	    $this->setIngredient($ingredient);
	    $this->setAmount($amount);
	    $this->setUnit($unit);
	}
	
	public function setIngrId($str){
	    $this->ingr_id = $str;    
	}
	public function getIngrId(){
	    return $this->ingr_id;    
	}
	public function setIngredient($str){
	    $this->ingredient = $str;
	}
	public function getIngredient(){
	    return $this->ingredient;    
	}
	public function setAmount($str){
	    $this->amount = $str;    
	}
	public function getAmount(){
	    return $this->amount;
	}
	public function setUnit($str){
	    $this->unit = $str;    
	}
	public function getUnit(){
	    return $this-> unit;
	}
	
	public static function loadIngredient($recipeId){
	    $sql = 'SELECT ingredient.name, recipe_to_ingredient.amount, recipe_to_ingredient.unit_id, unit.name FROM recipe_to_ingredient INNER JOIN ingredient ON (recipe_to_ingredient.ingredient_id = ingredient.id) INNER JOIN unit ON (recipe_to_ingredient.unit_id = unit.id) WHERE recipe_to_ingredient.recipe_id = :recipeId';

	    $params = array(':recipeId' =>  $recipeId);

	    $data = Database::getRow($sql, $params);
	    $ingr = new Ingredient($data['id'], $data['name'], $data['amount'], $data['unit_id']);
	    var_dump($data);
	    return $ingr;
	}

	public static function loadAllIngr($recipeId){
	    $sql = 'SELECT ingredient.name, recipe_to_ingredient.amount, recipe_to_ingredient.unit_id, unit.name FROM recipe_to_ingredient INNER JOIN ingredient ON (recipe_to_ingredient.ingredient_id = ingredient.id) INNER JOIN unit ON (recipe_to_ingredient.unit_id = unit.id) WHERE recipe_to_ingredient.recipe_id = :recipeId';
	    $params = array (':recipeId' => $recipeId);
	    $data = Database::getMultipleRows($sql, $params);
	    foreach($data as $key=>$data){
		$ingr = new Ingredient($data['id'], $data['name'], $data['amount'], $data['unit_id']);
		$array[] = $ingr;
	    }
	    return $array;
	}

	public static function loadIngredientsByName($ingredient_names){
	    $questionMarkArray = implode(',', array_fill(0, count($ingredient_names), '?'));
	    
	    $sql = 'SELECT * FROM ingredient WHERE name IN (' . $questionMarkArray . ')';
	    $ingredient_found = Database::getMultipleRows($sql, $ingredient_names, 'query_array');
	    if(empty($ingredient_found)){
		return array();
	    } else{
		$ingredients_array = array();
		foreach($ingredient_found as $ingredient){
		      $ingredients_array[] = new Ingredient($ingredient['id'], $ingredient['name'], null, null);
		}
		return $ingredients_array;
	    }
	
	}

	public static function ifExists($ingr){
	    $sql = 'SELECT id FROM ingredient WHERE name = :ingr';
	    $params = array(':ingr' => $ingr);
	    $result = Database::getRow($sql, $params);
	    $ingr_id = $result['id'];
	    return $ingr_id;
	}

	public static function insertMultipleIngredients($ingredients){
	    $names = array();
	    foreach($ingredients as $ingredient){
		$names[] = $ingredient->getIngredient();
	    }
	    $questionMarkArray = implode(',', array_fill(0, count($ingredients), '(?)'));
	    $sql = 'INSERT INTO ingredient (name) VALUES ' . $questionMarkArray; 
	    
	    Database::bulkInsert($sql, $names);
	}


    }

?>
