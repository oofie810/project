<?php
    $x = 'index';
    require_once ('../lib/appvars.php');
    require_once ('header.php');
    require_once ('../lib/Database.php');
    require_once ('../lib/SendEmail.php');
    require_once ('../lib/User.php');
    require_once ('../lib/Recipe.php');
    require_once ('../lib/Ingredient.php');
    require_once ('../lib/Image.php');
    /*$images = new Imagick('images/2010-ferrari-458-italia.jpg');
    $images->thumbnailImage(100, 0);
    $images->writeImage();
    */

  $user = User::loadUserFromUsername($_SESSION['username']);
  $id = $user->getUserId();
/*  
  $array = Image::loadImagesByUser($id);
  
  foreach($array as $pic){
    echo '<img src= "' . UP_PATH . $pic->getFilename() . '" />';
    echo $pic->getCaption();
  }
  
  $array2 = Image::loadImagesByRecipeId(1);

  foreach($array2 as $pic){
    echo '<img src= "' . UP_PATH . $pic->getFilename() . '" />';
    echo $pic->getCaption();
  }
*/
  $id = 1;
  $res = 1;
  $pic = Image::loadImageForSearchRecipe($id, $res);
  echo '<img src= "' . DISP . $pic->getFilename() . '"  />';

?>
