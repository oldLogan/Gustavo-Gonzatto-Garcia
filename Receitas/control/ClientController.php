<?php
include_once "model/Request.php";
include_once "model/Client.php";
include_once "database/DatabaseConnector.php";
class ClientController
{

	private $requiredParameters = array('name', 'lastName', 'cpf', 'rg', 'data', 'salary');

	public function register($request)
	{
		$params = $request->get_params();
		if($this->isValid($params)){
		$client = new Client($params["name"],
				 $params["lastName"],
				 $params["cpf"],
				 $params["rg"],
				 $params["data"],
				 $params["salary"]);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
	
		$conn = $db->getConnection();
		
	    return $conn->query($this->generateInsertQuery($client));
	    } else {
	    	echo "Error 400: Bad Request";
	    }	
	}

	private function generateInsertQuery($client)
	{
		$query =  "INSERT INTO client (name, lastName, cpf, rg, data, salary) VALUES ('".$client->getName()."','".
					$client->getLastName()."','".
					$client->getCpf()."','".
					$client->getRg()."','".
					$client->getDate()."','".  
					$client->getSalary()."')";
		return $query;						
	}

	public function search($request)
	{
		$params = $request->get_params();
		$crit = $this->generateCriteria($params);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		$conn = $db->getConnection();
		$result = $conn->query("SELECT * FROM client WHERE ".$crit);
		//foreach($result as $row) 
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	private function generateCriteria($params) 
	{
		$criteria = "";
		foreach($params as $key => $value)
		{
			$criteria = $criteria.$key." LIKE '%".$value."%' OR ";
		}
		return substr($criteria, 0, -4);	
	}

	public function update($request)
	{
		if(!empty($_GET["id"]) && !empty($_GET["name"]) && !empty($_GET["lastName"]) && !empty($_GET["cpf"]) && !empty($_GET["rg"]) && !empty($_GET["data"]) && !empty($_GET["salary"])){
			
			$name = addslashes(trim($_GET["name"]));
			$lastName = addslashes(trim($_GET["lastName"]));
			$cpf = addslashes(trim($_GET["cpf"]));
			$rg = addslashes(trim($_GET["rg"]));
			$data = addslashes(trim($_GET["data"]));
			$salary = addslashes(trim($_GET["salary"]));

			$params = $request->get_params();
			$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
			$conn = $db->getConnection();
			$result = $conn->prepare("UPDATE client SET name=:name, lastName=:lastName, cpf=:cpf, rg=:rg, data=:data, salary=:salary WHERE id=:id");
			$result->bindValue(":name", $name);
			$result->bindValue(":lastName", $lastName);
			$result->bindValue(":cpf", $cpf);
			$result->bindValue(":rg", $rg);
			$result->bindValue(":data", $data);
			$result->bindValue(":salary", $salary);
			$result->execute();
			if ($result->rowCount() > 0){
				echo "Cliente alterado com sucesso!";
			} else {
				echo "Cliente não atualizado";
			}
		}
	}

	public function delete ($request)
	{
		$params = $request->get_params();
		$cond = $this->generateDelete($params);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		
		$conn = $db->getConnection();
		
		$result = $conn->query("DELETE FROM client WHERE " .$cond);
	}

	private function generateDelete($params)
	{
		$criteria = "";
		foreach($params as $key => $value)
		{
			$criteria = $criteria.$key." = '".$value."' AND ";
		}
		return substr($criteria, 0, -4);	
	}

	private function isValid($parameters)
	{
		$keys = array_keys($parameters);
		$diff1 = array_diff($keys, $this->requiredParameters);
		$diff2 = array_diff($this->requiredParameters, $keys);
		if (empty($diff2) && empty($diff1))
			return true;
		return false;
	}
}