<?php
// Point to where you downloaded the phar
include('httpful.phar');


$url = "http://localhost/Receitas/user/?name=".$_POST['name']."&lastName=".$_POST['lastName']."&tipo=".$_POST['tipo']."&rg=".$_POST['rg']."&data=".$_POST['data']."&salary=".$_POST['salary']."&pass=".$_POST['pass'];

$response = \Httpful\Request::post($url)->send();
header('location:index2.html');
//var_dump($response);



// if($response->code == 200){
	
// }


// And you're ready to go!
//$response = \Httpful\Request::get('http://localhost/request/user/?first_name=sorte')->send();

//$request_response = json_decode($response->body);

//foreach($request_response as $value)
//{
//	echo $value->first_name . '<br>';
//	echo '<div class="checkbox">
 //         <label>
//            <input type="checkbox" value="remember-me"> Remember me
 //         </label>
//        </div>';
//}


