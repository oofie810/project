<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Recipes</title>
	<?php
	  if (!empty($css_files)){
	    foreach($css_files as $css_file){
		echo '<link rel="stylesheet" type="text/css" href="css/'.$css_file.'" />';
	    }
	  }
	  if(!empty($js_files)){
	    foreach($js_files as $js_file){
		echo '<script language="javascript" src="scripts/'.$js_file.'"></script>';
	    }    
	  }?>
    </head>
    <body>
	<div id="header">
	  <?php
	    if(session_id() == ''){
		session_start();
		if(isset($_SESSION['username'])){
		    echo '<a class="abc" href="http://192.168.1.103">HOME</a>';
		    echo '<a class="linkright" href="logout.php">LogOut</a>';
		    echo '<a class="linkright" href="viewprofile.php">'.$_SESSION['username'].'</a>';
		}
		else{
		    echo '<a class="abc" href="http://192.168.1.103">HOME</a>';
		    echo '<a class="linkright" href="signup.php">Sign Up</a>';
		    echo '<a class="linkright" href="login.php">Log In</a>';
		}
	    }
	?>
	 </div>
    
