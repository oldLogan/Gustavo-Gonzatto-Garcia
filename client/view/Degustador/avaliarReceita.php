<?php
// Point to where you downloaded the phar
include('../../httpful.phar');


$url = "http://localhost/Receitas/evaluation/?nameRecipe=".$_POST['nameRecipe']."&data=".$_POST['data']."&grade=".$_POST['grade'];

$response = \Httpful\Request::post($url)->send();
header('location:avaliarReceita2.html');