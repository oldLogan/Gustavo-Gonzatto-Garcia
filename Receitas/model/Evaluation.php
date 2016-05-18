<?php
	class Evaluation
	{
		private $nameDegustador;
		private $nameRecipe;
		private $data;
		private $grade;
		
		public function __construct ($nameDegustador, $nameRecipe, $data, $grade){
			$this->setNameDegustador($nameDegustador);
			$this->setNameRecipe($nameRecipe);
			$this->setDate($data);
			$this->setGrade($grade);
		}
		
		//SET
		
		public function setNameDegustador ($nameDegustador){
			$this->nameDegustador = $nameDegustador;
		}
		
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
		public function getNameDegustador (){
			return $this->nameDegustador;
		}
		
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