<?php
    $css_files = array('index.css');
    $js_files  = array('scripts.js');
    require_once ('../lib/appvars.php');
    require_once ('header.php');
    require_once ('../lib/Database.php');
    require_once ('../lib/SendEmail.php');
    require_once ('../lib/User.php');
    require_once ('../lib/Recipe.php');
    require_once ('../lib/Ingredient.php');
    require_once ('../lib/Image.php');
    
   
    echo "cookie is " . $_COOKIE['memCache'];

?>
