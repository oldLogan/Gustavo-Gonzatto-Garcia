<?php
	class Client
	{
		private $name;
		private $lastName;
		private $cpf;
		private $rg;
		private $data;
		private $salary;
		
		
		public function __construct ($name, $lastName, $cpf, $rg, $data, $salary){
			$this->setName($name);
			$this->setLastName($lastName);
			$this->setCpf($cpf);
			$this->setRg($rg);
			$this->setDate($data);
			$this->setSalary($salary);
		}
		
		//SET
		
		public function setName ($name){
			$this->name = $name;
		}
		
		public function setLastName ($lastName){
			$this->lastName = $lastName;
		}
		
		public function setCpf ($cpf){
			$this->cpf = $cpf;
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
		
		//GET
		public function getName (){
			return $this->name;
		}
		
		public function getLastName (){
			return $this->lastName;
		}
		
		public function getCpf (){
			return $this->cpf;
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
		
		
	}