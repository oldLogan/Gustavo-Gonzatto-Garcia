<?php
// Point to where you downloaded the phar
include('../../httpful.phar');


$response = \Httpful\Request::get('http://localhost/Receitas/evaluation/?nameRecipe='.$_POST['nameRecipe'])->send();

if($response->code == 200){
$request_response = json_decode($response->body);
  if($request_response[0]->nameRecipe == $_POST['nameRecipe']){
    session_start();
    $_SESSION['id']=$request_response[0]->id;
    $_SESSION['nameRecipe']=$request_response[0]->nameRecipe;
    $_SESSION['data']=$request_response[0]->data;
    $_SESSION['grade']=$request_response[0]->grade;
    include 'avaliacao.html';

  }
  else{
    header('location:consultarReceita.html');
  }
}
else{
  header('location:error.html');
}
