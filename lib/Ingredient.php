<?php
  class Ingredient{
	  private $id, $name, $amount, $unit_name;

	  public function __construct($id, $name, $amount, $unit_name){
      $this->id = $id;
	    $this->unit_name = $unit_name;
	    $this->setIngredient($name);
	    $this->setAmount($amount);
	  }
	
	  public function getId(){
	    return $this->id;    
	  }
	  public function setName($name){
	    $this->name = $name;
	  }
	  public function getName(){
	    return $this->name;    
	  }
	  public function setAmount($amount){
	    $this->amount = $amount;    
	  }
	  public function getAmount(){
	    return $this->amount;
	  }
	  public function getUnitName(){
	    return $this->unit_name;
	  }
	
	  public static function loadRecipeIngredients($recipeId){
	    $sql = "
		    SELECT
		      i.name AS ingredient_name,
		      rti.amount,
		      u.name AS unit_name
		    FROM recipe_to_ingredient rti
		    JOIN ingredient i ON rti.ingredient_id = i.id
		    JOIN unit u ON rti.unit_id = u.id
		    WHERE
		      rti.recipe_id = :recipeId";
		    
	    $params = array (':recipeId' => $recipeId);
	    $data = Database::getMultipleRows($sql, $params);
      $ingredients_array = array();
	    foreach($data as $key=>$data){
		    $ingredients_array [] = new Ingredient($data['id'], $data['ingredient_name'], $data['amount'], $data['unit_name']);
	    }
	    return $ingredients_array;
	  }

	  public static function loadMultipleIngredientNames($ingredient_names){
	    $questionMarkArray = implode(',', array_fill(0, count($ingredient_names), '?'));
	    
	    $sql = 'SELECT name FROM ingredient WHERE name IN (' . $questionMarkArray . ')';
	    $names_found = Database::getMultipleRows($sql, $ingredient_names);
	    if(empty($names_found)){
		    return array();
	    } else{
		    $ingredient_names_found = array();
		    foreach($names_found as $name){
		      $ingredient_names_found[] = $name;
		    }
		  return $ingredient_names_found;
	    }
	  }

	  public static function insertMultipleIngredients($ingredient_names){
	    $questionMarkArray = implode(',', array_fill(0, count($ingredient_names), '(?)'));
	    $sql = 'INSERT INTO ingredient (name) VALUES ' . $questionMarkArray; 
	    
	    Database::bulkInsert($sql, $ingredient_names);
	  } 

  }

?>
