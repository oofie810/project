<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Recipes</title>
    <?php
      require_once('../lib/User.php');
	    if (!empty($css_files)){
	      foreach($css_files as $css_file){
	      echo '<link rel="stylesheet" type="text/css" href="css/'.$css_file.'" />';
	      }
	    }
	    if(!empty($js_files)){
	      foreach($js_files as $js_file){
	        echo '<script language="javascript" src="scripts/'.$js_file.'"></script>';
	      }       
	    }
    ?>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"/></script>
      <script src="scripts/galleria-1.2.8.min.js"></script>
  </head>
  <body>
    <div id="header">
    <?php
      if(session_id() == ''){
	      session_start();
	      if(User::isLoggedIn()){
            echo '<ul id="menu">';
              echo '<li><a href="http://192.168.1.103">HOME</a></li>';
              echo '<li><a href="">Recipes</a>';
                echo '<ul>';
                  echo '<li><a href="submit.php">Submit</a></li>';
                echo '</ul>';
                echo '</li>';
              echo '<li><a href="">User CP</ a>';
                echo '<ul>';
                  echo '<li><a href="editprofile.php">Edit Profile</a></li>';
                  echo '<li><a href="usersettings.php">Edit Settings</a></li>';
                echo '</ul>';
              echo '</li>';
              echo '<span class="right"><li><a href="viewprofile.php">'.$_SESSION['username'].'</a></li>';
              echo '<li><a href="logout.php">LogOut</a></li></span>';
            echo '</ul>';
        } else{
          echo '<a class="abc" href="http://192.168.1.103">HOME</a>';
          echo '<a class="linkright" href="signup.php">Sign Up</a>';
          echo '<a class="linkright" href="login.php">Log In</a>';
        }
      }
    ?>
    </div>
