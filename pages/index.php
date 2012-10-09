<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');

  if(User::isLoggedIn()){
    echo '<p>You are logged in as ' .$_SESSION['username']. '</p>';
    echo '<p>You can submit recipes using this <a href="submit.php">link</a></p>';
    echo '<p>You can edit your profile <a href="editprofile.php">here</a></p>';
    echo '<p>You can edit your user settings <a href="usersettings.php">here</a></p>';
    echo $_SERVER['REMOTE_ADDR'];
  }
  $data = Recipe::lazyLoadRecipes();
  foreach ($data as $recipe){
    echo '<ul>';
    echo '<li><a href="viewrecipe.php?recipe_id='. $recipe['id']. '">'.$recipe['name'].'</a></li>';
    echo '</li>' .substr($recipe['directions'], 0, 230) . '...</li><br />';
    echo '</ul>';
  }

  require_once('footer.php');
?>

