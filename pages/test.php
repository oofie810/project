<?php
    $x = 'index';
    require_once ('../lib/connectvars.php');
    require_once ('../lib/header.php');
    require_once ('../lib/Database.php');
    require_once ('../lib/SendEmail.php');
    require_once ('../lib/User.php');
    require_once ('../lib/Recipe.php');
    require_once ('../lib/Ingredient.php');
    
    $st = User::isLoggedIn($_SESSION['username']);
    echo $st;
?>
