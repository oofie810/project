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
    /*$images = new Imagick('images/2010-ferrari-458-italia.jpg');
    $images->thumbnailImage(100, 0);
    $images->writeImage();
    */
?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
     <ul id="picture_input">
      <li><label for="picture">Picture:</label>
      <input type="file" id="picture" name="picture[]" />
      <label for="caption">Caption:</label>
      <input type="text" id="caption" name="caption[]" /></li>
     </ul>
      <input id="button" type="submit" value="save" name="submit" />
     <ul>
     <li><button type="button" name="button" onClick="newRowForImages('picture_input');">+++</li>
     </ul>

<?php
  $user = User::loadUserFromUsername($_SESSION['username']);
  $id = $user->getUserId();
  if(isset($_POST['submit'])){
    $pic = $_FILES['picture']['name'];
    $caption = $_POST['caption'];
  } 
  
  if(!empty($pic)){
    Image::saveImageWithCaption($pic, $id, $caption, 1);
  }



require_once('footer.php');

?>
