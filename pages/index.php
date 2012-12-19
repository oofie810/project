<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');

  if(User::isLoggedIn()){
  }
 
  
 ?>


  <div id="search">
    <form method="get" action="search.php">
      <ul>
      <li><input size="50" type="text" id="search_box" name="search_box" />
      <input type="submit" value="Search" name="search" /></li>
      </ul>
    </form>
  </div>
  
  <div id="column1">Column1</div>

  <div id="column2">Column2</div>


<?php
  require_once('footer.php');
?>

