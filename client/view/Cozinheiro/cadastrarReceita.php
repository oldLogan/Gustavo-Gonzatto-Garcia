<?php
// Point to where you downloaded the phar
include('../../httpful.phar');


$url = "http://localhost/Receitas/recipe/?nameRecipe=".$_POST['nameRecipe']."&nameChef=".$_POST['nameChef']."&data=".$_POST['data']."&category=".$_POST['category'];

$response = \Httpful\Request::post($url)->send();
header('location:../../cadastrarReceita2.html');