<?php
	class User
	{
		private $name;
		private $lastName;
		private $tipo;
		private $rg;
		private $data;
		private $salary;
		private $pass;
		
		
		public function __construct ($name, $lastName, $tipo, $rg, $data, $salary, $pass){
			$this->setName($name);
			$this->setLastName($lastName);
			$this->setTipo($tipo);
			$this->setRg($rg);
			$this->setDate($data);
			$this->setSalary($salary);
			$this->setPass($pass);
		}
		
		//SET
		
		public function setName ($name){
			$this->name = $name;
		}
		
		public function setLastName ($lastName){
			$this->lastName = $lastName;
		}
		
		public function setTipo ($tipo){
			$this->tipo = $tipo;
		}
		
		public function setRg ($rg){
			$this->rg = $rg;
		}
		
		public function setDate ($data){
			$this->data = $data;
		}
		
		public function setSalary($salary){
			$this->salary = $salary;
		}
		
		public function setPass($pass){
			$this->pass = $pass;
		}	
		

		//GET
		public function getName (){
			return $this->name;
		}
		
		public function getLastName (){
			return $this->lastName;
		}
		
		public function getTipo (){
			return $this->tipo;
		}
		
		public function getRg (){
			return $this->rg;
		}
		
		public function getDate(){
			return $this->data;
		}
		
		public function getSalary(){
			return $this->salary;
		}
		
		public function getPass(){
			return $this->pass;
		}
		
	}