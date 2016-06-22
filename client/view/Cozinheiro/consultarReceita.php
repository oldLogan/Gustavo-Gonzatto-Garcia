<?php
// Point to where you downloaded the phar
include('../../httpful.phar');


$response = \Httpful\Request::get('http://localhost/Receitas/recipe/?nameRecipe='.$_POST['nameRecipe'])->send();

if($response->code == 200){
$request_response = json_decode($response->body);
	if($request_response[0]->nameRecipe == $_POST['nameRecipe'] && $request_response[0]->nameChef == $_POST['nameChef']){
		session_start();
		$_SESSION['id']=$request_response[0]->id;
		$_SESSION['nameRecipe']=$request_response[0]->nameRecipe;
		$_SESSION['data']=$request_response[0]->data;
		$_SESSION['category']=$request_response[0]->category;
		$_SESSION['nameChef']=$request_response[0]->nameChef;
		include 'consulta.html';

	}
	else{
		header('location:consultarReceita.html');
	}
}
else{
	header('location:error.html');
}





//$request_response['first_name'];

/*foreach($request_response as $value)
{
	echo $value->first_name . '<br>';
	echo '<div class="checkbox">
          <label>
           <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>';
}

*/
