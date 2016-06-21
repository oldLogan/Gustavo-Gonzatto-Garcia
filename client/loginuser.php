<?php
// Point to where you downloaded the phar
include('httpful.phar');

// And you're ready to go!
$response = \Httpful\Request::get('http://localhost/Receitas/user/?name='.$_POST['name'])->send();

if($response->code == 200){
$request_response = json_decode($response->body);
	if($request_response[0]->name == $_POST['name'] && $request_response[0]->pass == $_POST['pass'] && $request_response[0]->tipo == $_POST['tipo']){
		session_start();
		$_SESSION['id']=$request_response[0]->id;
		$_SESSION['name']=$request_response[0]->name;
		$_SESSION['lastName']=$request_response[0]->lastName;
		$_SESSION['tipo']=$request_response[0]->tipo;
		$_SESSION['rg']=$request_response[0]->rg;
		$_SESSION['data']=$request_response[0]->data;
		$_SESSION['salary']=$request_response[0]->salary;
		if($_POST['tipo'] == "cozinheiro"){
			include 'cozinheiro.html';
		}elseif ($_POST['tipo'] == "degustador") {
			include 'degustador.html';
		}elseif($_POST['tipo'] == "editor"){
			include 'editor.html';
		}
		

	}
	else{
		header('location:login2.html');
	}
}
else{
	header('location:error.html');
}
