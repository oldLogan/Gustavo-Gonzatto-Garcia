<?php
include_once "model/Request.php";
include_once "model/Evaluation.php";
include_once "database/DatabaseConnector.php";
class EvaluationController
{
	private $requiredParameters = array('nameRecipe', 'data', 'grade');

	public function register($request)
	{
		$params = $request->get_params();
		if($this->isValid($params)){
		$evaluation = new Evaluation($params["nameRecipe"],
				 $params["data"],
				 $params["grade"]);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		$conn = $db->getConnection();
		
		
	    return $conn->query($this->generateInsertQuery($evaluation));
	    }else{
	    	echo "Error: 400 Bad Request";
	    }	
	}
	private function generateInsertQuery($evaluation)
	{
		$query =  "INSERT INTO evaluation (nameRecipe, data, grade) VALUES ('".$evaluation->getNameRecipe()."','".
					$evaluation->getDate()."','".
					$evaluation->getGrade()."')";
		return $query;						
	}

	public function search($request)
	{
		$params = $request->get_params();
		$crit = $this->generateCriteria($params);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		$conn = $db->getConnection();
		$result = $conn->query("SELECT * FROM evaluation WHERE ".$crit);
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
		$params = $request->get_params();
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		$conn = $db->getConnection();
		foreach ($params as $key => $value) {
			$result = $conn->query("UPDATE evaluation SET " . $key . " =  '" . $value . "' WHERE id = '" . $params["id"] . "'");
		}
		return $result;
	}

	public function delete ($request)
	{
		$params = $request->get_params();
		$cond = $this->generateDelete($params);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		
		$conn = $db->getConnection();
		
		$result = $conn->query("DELETE FROM evaluation WHERE " .$cond);
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