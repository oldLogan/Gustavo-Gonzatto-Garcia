<?php
include_once "model/Request.php";
include_once "model/User.php";
include_once "database/DatabaseConnector.php";

class UserController
{
	private $requiredParameters = array('name', 'lastName', 'tipo', 'rg', 'data', 'salary', 'pass');

	public function register($request)
	{
		$params = $request->get_params();
		if($this->isValid($params)){
		$user = new user($params["name"],
				 $params["lastName"],
				 $params["tipo"],
				 $params["rg"],
				 $params["data"],
				 $params["salary"],
				 $params["pass"]);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
	
		$conn = $db->getConnection();
		
	    return $conn->query($this->generateInsertQuery($user));
	    }else {
	    	echo "Error 400: Bad Request";
	    }	
	}

	private function generateInsertQuery($user)
	{
		$query =  "INSERT INTO user (name, lastName, tipo, rg, data, salary, pass) VALUES ('".$user->getName()."','".
					$user->getLastName()."','".
					$user->getTipo()."','".
					$user->getRg()."','".
					$user->getDate()."','".
					$user->getSalary()."','".  
					$user->getPass()."')";
		return $query;						
	}

	public function search($request)
	{
		$params = $request->get_params();
		$crit = $this->generateCriteria($params);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		$conn = $db->getConnection();
		$result = $conn->query("SELECT * FROM user WHERE ".$crit);
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
		if(!empty($_GET["id"]) && !empty($_GET["name"]) && !empty($_GET["lastName"]) && !empty($_GET["tipo"]) && !empty($_GET["rg"]) && !empty($_GET["data"]) && !empty($_GET["salary"])&& !empty($_GET["pass"])){
			
			$name = addslashes(trim($_GET["name"]));
			$lastName = addslashes(trim($_GET["lastName"]));
			$tipo = addslashes(trim($_GET["tipo"]));
			$rg = addslashes(trim($_GET["rg"]));
			$data = addslashes(trim($_GET["data"]));
			$salary = addslashes(trim($_GET["salary"]));
			$pass = addslashes(trim($_GET["pass"]));

			$params = $request->get_params();
			$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
			$conn = $db->getConnection();
			$result = $conn->prepare("UPDATE user SET name=:name, lastName=:lastName, tipo=:tipo, rg=:rg, data=:data, salary=:salary, pass=:pass WHERE id=:id");
			$result->bindValue(":name", $name);
			$result->bindValue(":lastName", $lastName);
			$result->bindValue(":tipo", $tipo);
			$result->bindValue(":rg", $rg);
			$result->bindValue(":data", $data);
			$result->bindValue(":salary", $salary);
			$result->bindValue(":pass", $pass);
			$result->execute();
			if ($result->rowCount() > 0){
				echo "Usuario alterado com sucesso!";
			} else {
				echo "Usuario não atualizado";
			}
		}
	}

	public function delete ($request)
	{
		$params = $request->get_params();
		$cond = $this->generateDelete($params);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		
		$conn = $db->getConnection();
		
		$result = $conn->query("DELETE FROM user WHERE " .$cond);
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