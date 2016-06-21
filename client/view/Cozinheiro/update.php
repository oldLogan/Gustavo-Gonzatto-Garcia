<?php
include('../../httpful.phar');

session_start();

$url = "http://localhost/Receitas/recipe/nameRecipe=".$_SESSION['nameRecipe']
    ."&nameChef=".$_POST['nameChef']
    ."&category=".$_POST['category'];

$response = \Httpful\Request::put($url)->send();

$response = \Httpful\Request::get('http://localhost/Receita/recipe/?id='.$_SESSION['id'])->send();
$request_response = json_decode($response->body);
$_SESSION['nameRecipe']=$request_response[0]->nameRecipe;
$_SESSION['nameChef']=$request_response[0]->nameChef;
$_SESSION['category']=$request_response[0]->category;

include('consulta.html');
