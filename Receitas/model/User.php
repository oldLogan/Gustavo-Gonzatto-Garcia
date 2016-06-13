<?php
class User
{
	private $name;
	private $lastName;
	private $email;
	private $birthdate;
	private $phone;
	private $password;
	public function __construct($name, $lastName,
	$email, $birthdate, $phone, $password)
	{
		$this->name = $name;
		$this->last_name = $lastName;
		$this->email = $email;
		$this->birthdate = $birthdate;
		$this->phone = $phone;
		$this->password = $password;
	}

	private function setName ($name){
		$this->name = $name;
	}
	
	private function setLastName ($lastName){
		$this->lastName = $lastName;
	}
	
	private function setEmail ($email){
		$this->email = $email;
	}
	
	private function setBirthDate ($birthdate){
		$this->birthdate = $birthdate;
	}
	
	private function setPhone($phone){
		$this->phone = $phone;
	}
	
	private function setPassword($password){
		$this->password = $password;
	}
	
	
	public function getName()
	{
		return $this->name;
	}
	public function getLastname()
	{
		return $this->last_name;
	}
	public function getPhone()
	{
		return $this->phone;
	}
	public function getBirthdate()
	{
		return $this->birthdate;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getPassword()
	{
		return $this->password;
	}
}