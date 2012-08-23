<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Recipes</title>
	<?php
	  if ($x == 'index'){ ?>
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	
	<?php }
	  if ($x == 'editprof'){  ?>
        <link rel="stylesheet" type="text/css" href="css/index.css" />
	<link rel="stylesheet" type="text/css" href="css/editprof.css" />
	
	<?php } 
	  if ($y == 'js'){   ?>
	<script language="javascript" src="scripts/scripts.js"></script>
	<?php }		?>
    </head>
    <body>
	<div id="header">
	  <?php
	    if(isset($_SESSION['username'])){
		echo '<a class="abc" href="http://54.245.125.72">HOME</a>';
		echo '<a class="linkright" href="logout.php">LogOut</a>';
		echo '<a class="linkright" href="viewprofile.php">'.$_SESSION['username'].'</a>';
		}
	    else{
		echo '<a class="abc" href="http://54.245.125.72">HOME</a>';
		echo '<a class="linkright" href="signup.php">Sign Up</a>';
		echo '<a class="linkright" href="login.php">Log In</a>';
		}
	    ?>
	 </div>
    
