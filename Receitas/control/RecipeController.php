<?php
include_once "model/Request.php";
include_once "model/Recipe.php";
include_once "database/DatabaseConnector.php";
class UserController
{
	public function register($request)
	{
		$params = $request->get_params();
		$recipe = new Recipe($params["nameRecipe"],
				 $params["nameChef"],
				 $params["data"],
				 $params["category"]);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		$conn = $db->getConnection();
		
		
	    return $conn->query($this->generateInsertQuery($recipe));	
	}
	private function generateInsertQuery($recipe)
	{
		$query =  "INSERT INTO recipe (nameRecipe, nameChef, data, category) VALUES ('".$recipe->getNameRecipe()."','".
					$recipe->getNameChef()."','".
					$recipe->getDate()."','".
					$recipe->getCategory()."')";
		return $query;						
	}

	public function search($request)
	{
		$params = $request->get_params();
		$crit = $this->generateCriteria($params);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		$conn = $db->getConnection();
		$result = $conn->query("SELECT * FROM recipe WHERE ".$crit);
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

	public function delete ($request)
	{
		$params = $request->get_params();
		$cond = $this->generateDelete($params);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		
		$conn = $db->getConnection();
		
		$result = $conn->query("DELETE FROM recipe WHERE " .$cond);
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
}