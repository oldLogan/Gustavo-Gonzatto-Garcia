<?php
include_once "model/Request.php";
include_once "model/User.php";
include_once "database/DatabaseConnector.php";

class UserController
{
	private $requiredParameters = array('name', 'lastName', 'email', 'birthdate', 'phone', 'password');

	public function register($request)
	{
		$params = $request->get_params();

		if($this->isValid($params)){
		$user = new User($params["name"],
				 $params["lastName"],
				 $params["email"],
				 $params["birthdate"],
				 $params["phone"],
				 $params["password"]);

		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");

		$conn = $db->getConnection();
		
	    return $conn->query($this->generateInsertQuery($user));	
		}else{
			echo "Error 400: Bad Request";
		}
	}

	private function generateInsertQuery($user)
	{
		$query =  "INSERT INTO user (name, lastName, email, birthdate, phone, pass) VALUES ('".$user->getName()."','".
					$user->getLastName()."','".
					$user->getEmail()."','".
					$user->getBirthdate()."','".
					$user->getPhone()."','". 
					$user->getPassword()."')";
		return $query;						
	}

	public function search($request)
	{
		$params = $request->get_params();
		$crit = $this->generateCriteria($params);
		$db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
		$conn = $db->getConnection();

		$result = $conn->query("SELECT name, lastName, email, birthdate, phone FROM user WHERE ".$crit);
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
		if(!empty($_GET["id"]) && !empty($_GET["name"]) && !empty($_GET["lastName"]) && !empty($_GET["email"]) && !empty($_GET["birthdate"])) {

            $name = addslashes(trim($_GET["name"]));
            $lastName = addslashes(trim($_GET["lastName"]));
            $email = addslashes(trim($_GET["email"]));
            $birthdate = addslashes(trim($_GET["birthdate"]));
            $id = addslashes(trim($_GET["id"]));

            $params = $request->get_params();
            $db = new DatabaseConnector("localhost", "receita", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE user SET name=:name, lastName=:lastName, email=:email, birthdate=:birthdate WHERE id=:id");
            $result->bindValue(":name", $name);
            $result->bindValue(":lastName", $lastName);
            $result->bindValue(":email", $email);
            $result->bindValue(":birthdate", $birthdate);
            $result->bindValue(":id", $id);
            $result->execute();
            if ($result->rowCount() > 0){
                echo "Usuário alterado com sucesso!";
            } else {
                echo "Usuário não atualizado";
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
        if (empty($diff2) && empty($diff1)){
            return true;
		}
		else{
        return false;
		}
    }
}