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
	    $db = new Database();

	    $sql = 'SELECT ingredients.ingredient, rec_ing.amount, rec_ing.units, units.units FROM rec_ing INNER JOIN ingredients ON (rec_ing.ingr_id = ingredients.ingr_id) INNER JOIN units ON (rec_ing.units = units.id) WHERE rec_ing.rec_id = :recipeId';

	    $params = array(':recipeId' =>  $recipeId);

	    $db -> query ($sql, $params);
	    $data = $db -> getData();
	    $ingr = new Ingredient($data['ingr_id'], $data['ingredient'], $data['amount'], $data['units']);
	    var_dump($data);
	    return $ingr;
	}
	public static function loadAllIngr($recipeId){
	    $db = new Database();
		    
	    $sql = 'SELECT ingredients.ingredient, rec_ing.amount, rec_ing.units, units.units FROM rec_ing INNER JOIN ingredients ON (rec_ing.ingr_id = ingredients.ingr_id) INNER JOIN units ON (rec_ing.units = units.id) WHERE rec_ing.rec_id = :recipeId';
	    $params = array (':recipeId' => $recipeId);
	    $db -> query($sql, $params);
	    $data = $db->getAll();
	    foreach($data as $key=>$data){
		$ingr = new Ingredient($data['ingr_id'], $data['ingredient'], $data['amount'], $data['units']);
		$array[] = $ingr;
	    }
	    return $array;
	}

	public static function ifExists($ingr){
	    $db = new Database();
	    $sql = 'SELECT ingr_id FROM ingredients WHERE ingredient = :ingr';
	    $params = array(':ingr' => $ingr);
	    $db -> query($sql, $params);
	    $result = $db->getData();
	    $ingr_id = $result['ingr_id'];
	    return $ingr_id;
	}
	
	public static function insertIngredient($ingr){
	    $db = new Database();
	    $sql = 'INSERT INTO ingredients (ingredient) VALUES (:ingr)';
	    $params = array (':ingr' => $ingr);
	    $id = $db -> insert($sql, $params);

	    return $id;
	}

    }

?>
