<?php
include('../../httpful.phar');

session_start();

$url = "http://localhost/Receitas/recipe/?nameChef=".$_POST['nameChef']."&nameRecipe=".$_POST['nameRecipe'];
    $response = \Httpful\Request::delete($url)->send();
header('location:confirm.html');