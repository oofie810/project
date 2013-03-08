<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');

  if(User::isLoggedIn()){
  }
 ?>

  
  <div id="search">
    <form method="get" action="search.php" id="searchform">
      <ul>
      <li><input size="50" type="text" id="search_box" name="search_box" />
      <input type="submit" value="Search" name="search" /></li>
      </ul>
    </form>
  </div>
  
  <div id="column1">Column1<br />
		<form method="post" action="viewmeal.php">
			<select id="planner" name="meal"/>
				<option value ="1">1 course</option>
				<option value ="2">2 courses</option>
				<option value ="3">3 courses</option>
				<option value ="4">4 courses</option>
				<input type="submit" value="Submit" name="submitMeal" />
		</form>
  </div>


<?php
  require_once('footer.php');
?>

