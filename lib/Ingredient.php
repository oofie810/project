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
	
    }
?>
