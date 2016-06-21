<?php
	class Evaluation
	{
		private $nameRecipe;
		private $data;
		private $grade;
		
		public function __construct ($nameRecipe, $data, $grade){
			$this->setNameRecipe($nameRecipe);
			$this->setDate($data);
			$this->setGrade($grade);
		}
		
		//SET
		public function setNameRecipe ($nameRecipe){
			$this->nameRecipe = $nameRecipe;
		}
		
		public function setDate ($data){
			$this->data = $data;
		}
		
		public function setGrade ($grade){
			$this->grade = $grade;
		}
		
		//GET
		public function getNameRecipe (){
			return $this->nameRecipe;
		}
		
		public function getDate (){
			return $this->data;
		}
		
		public function getGrade (){
			return $this->grade;
		}
		
		
	}