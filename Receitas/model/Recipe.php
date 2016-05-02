<?php
	class Recipe 
	{
		private $nameRecipe;
		private $nameChef;
		private $data;
		private $category;
		
		public function __construct ($nameRecipe, $nameChef, $data, $category){
			$this->setNameRecipe($nameRecipe);
			$this->setNameChef($nameChef);
			$this->setDate($data);
			$this->setCategory($category);
		}
		
		//SET
		
		public function setNameRecipe ($nameRecipe){
			$this->nameRecipe = $nameRecipe;
		}
		
		public function setNameChef ($nameChef){
			$this->nameChef = $nameChef;
		}
		
		public function setDate ($data){
			$this->data = $data;
		}
		
		public function setCategory ($category){
			$this->category = $category;
		}
		
		//GET
		public function getNameRecipe (){
			echo $nameRecipe;
		}
		
		public function getNameChef (){
			echo $nameChef;
		}
		
		public function getDate (){
			echo $data;
		}
		
		public function getCategory(){
			echo $category;
		}
		
		
		
	}