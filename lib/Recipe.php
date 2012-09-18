<?php	
    class Recipe{
	private $recipeName, $directions;

	public function __construct($recipeName, $directions){
	    $this->setRecipeName($recipeName);
	    $this->setDirections($directions);
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

	public static function loadRecipe($recipeId){
	    $db = new Database();

	    $sql = 'SELECT recipe.rec_name, recipe.rec_id, ingredients.ingredient, rec_ing.amount, rec_ing.units, recipe.directions, units.units FROM recipe INNER JOIN rec_ing ON (rec_ing.rec_id = recipe.rec_id) INNER JOIN ingredients ON (ingredients.ingr_id = rec_ing.ingr_id) INNER JOIN units ON (rec_ing.units = units.id) WHERE recipe.rec_id = :id';

	    $params = array (':id' => $recipeId);

	    $db -> query($sql, $params);
	    $data = $db -> getData();
	    $recipe = new Recipe($data['rec_name'], $data['directions']);
	    return $recipe;
	}
	
	public static function loadAll(){
	    $db = new Database();
	    $sql = 'SELECT rec_name, rec_id, directions FROM recipe ORDER BY submission_date DESC';

	    $params = array();
	    $db -> query($sql, $params);
	    $getAll = $db->getAll();
	    var_dump($getAll);
	    return $getAll;
	}

    }
?>
