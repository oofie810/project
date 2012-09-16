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
	
    
    }
?>
