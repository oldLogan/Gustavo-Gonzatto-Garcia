<?php
include_once "model/Request.php";
include_once "model/Evaluation.php";
include_once "database/DatabaseConnector.php";
class EvaluationController
{
	private $requiredParameters = array('nameDegustador', 'nameRecipe', 'data', 'grade');

	public function register($request)
	{
		$params = $request->get_params();
		if($this->isValid($params)){
		$evaluation = new Evaluation($params["nameDegustador"],
				 $params["nameRecipe"],
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
		$query =  "INSERT INTO evaluation (nameDegustador, nameRecipe, data, grade) VALUES ('".$evaluation->getNameDegustador()."','".
					$evaluation->getNameRecipe()."','".
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
		if(!empty($_GET["id"]) && !empty($_GET["nameDegustador"]) && !empty($_GET["nameRecipe"]) && !empty($_GET["data"]) 
								&& !empty($_GET["grade"])) {

			$nameDegustador = addslashes(trim($_GET["nameDegustador"]));
			$nameRecipe = addslashes(trim($_GET["nameRecipe"]));
			$data = addslashes(trim($_GET["data"]));
			$grade = addslashes(trim($_GET["grade"]));

			$params = $request->get_params();
			$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
			$conn = $db->getConnection();
			$result = $conn->prepare("UPDATE evaluation SET nameDegustador=:nameDegustador, nameRecipe=:nameRecipe, data=:data, 
									  grade=:grade WHEREid=:id");
			$result->bindValue(":nameDegustador", $nameDegustador);
			$result->bindValue(":nameRecipe", $nameRecipe);
			$result->bindValue(":data", $data);
			$result->bindValue(":grade", $grade);
			$result->bindValue(":product", $product);
			$result->execute();
			if ($result->rowCount() > 0){
				echo "Notta alterada com sucesso!";
			} else {
				echo "Nota não atualizada";
			}
		}
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