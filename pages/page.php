<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Recipes</title>
<link href="css/jquery.thumbnailScroller.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"/></script>
<script src="scripts/galleria-1.2.8.min.js"></script>
<?php
require_once('../lib/User.php');
echo '<link rel="stylesheet" type="text/css" href="css/index.css" />';
echo '<script language="javascript" src="scripts/scripts.js"></script>';
?>
</head>
<body>
<div id="header">
<?php
if(session_id() == ''){
session_start();
  if(User::isLoggedIn()){
echo '<a class="abc" href="http://192.168.1.103">HOME</a>';
echo '<a class="linkright" href="logout.php">LogOut</a>';
echo '<a class="linkright" href="viewprofile.php">'.$_SESSION['username'].'</a>';
} else{
echo '<a class="abc" href="http://192.168.1.103">HOME</a>';
  echo '<a class="linkright" href="signup.php">Sign Up</a>';
echo '<a class="linkright" href="login.php">Log In</a>';
}
}
?>
</div>

<style>
  #galleria{
    width: 700px; height: 400px; background: #000
  }
</style>

<?php
  require_once('../lib/appvars.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');
  require_once('../lib/Image.php');

  $array = Image::loadImagesByUser(9);
  foreach($array as $pic){ ?>
<div id="galleria">
  <?php
  echo '<img src="' . UP_PATH . $pic->getFilename() . '" />';
  //<img src="thumbs/img2.jpg">
  //<img src="thumbs/img3.jpg">
  //<img src="thumbs/img4.jpg">
  }
  ?>
</div>

<script>
    Galleria.loadTheme('scripts/galleria/themes/classic/galleria.classic.min.js');
    Galleria.run('#galleria');
</script>

<?php require_once('footer.php'); ?>
