<?php
    $x = 'index';
    require_once ('../lib/connectvars.php');
    require_once ('../lib/header.php');
    require_once ('../lib/Database.php');
    require_once ('../lib/SendEmail.php');
    require_once ('../lib/User.php');
    require_once ('../lib/Recipe.php');
    require_once ('../lib/Ingredient.php');
    
    $email = 'ron.ongjoco@gmail.com';
    $subject = 'test';
    $message = "testing";
    
    #mail('ron.ongjoco@gmail.com', 'the subject', 'the message', null, 
     # '-fron.ongjoco@gmail.com'); 
    $sent = mail($email, $subject, $message);

    echo $sent;


?>
