<?php
include_once "model/Request.php";
include_once "control/UserController.php";
include_once "control/EvaluationController.php";
include_once "control/RecipeController.php";
include_once "control/UserController.php";

class ResourceController
{
	private $controlMap = 
	[
		"user" => "UserController",
		"evaluation" => "EvaluationController",
		"recipe" => "RecipeController",
	];

	public function createResource($request)
	{
		return (new $this->controlMap[$request->get_resource()]())->register($request);
	}
	
	public function searchResource($request)
	{
		return (new $this->controlMap[$request->get_resource()]())->search($request);
	}
	
	public function updateResource ($request)
	{
		return (new $this->controlMap[$request->get_resource()]())->update($request);
	}
	
	public function deleteResource ($request)
	{
		return (new $this->controlMap[$request->get_resource()]())->delete($request);
	}
}